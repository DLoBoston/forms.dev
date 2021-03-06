<?php
/**
 * Controller for form display.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

/**
 * Controller for form display.
 */
class FormDisplayController extends Controller
{
	
	/**
	 * Display custom form. Used for creating and updating end-user submissions.
	 * 
	 * @param \Slim\Http\Request $request PSR-7 Request
	 * @param \Slim\Http\Response $response PSR-7 Response
	 * @param array $args Named placeholders from the URL
	 * @param int $submission_id Query string parameter if a submission is being updated.
	 * @return \Slim\Http\Response $response PSR-7 Response
	 */
	public function showForm(Request $request, Response $response, array $args)
	{	
		// Get form data
		$this->container->get('orm');
		$form = \IFS\Models\Form::with(
				['form_sections.form_fields' => function($query) {
					$query->orderBy('form_fields.order', 'asc');
				}])
				->findOrFail((int)$args['id']);
			
			// Make sure sections are sorted
			$form->form_sections = $form->form_sections->sortBy('order');
								
		// Get URI object for route to be passed to template
		$uri = $request->getUri();
		
		// If applicable, get submission id from query string
		$submission_id = $request->getQueryParam('submission_id');
		
		// If applicable, get previous submission
		$submission = null;
		$keyed_submission_values = null;
		if ($submission_id) :
			$submission = \IFS\Models\FormSubmission::with('form_submission_values')->findOrFail((int)$submission_id);
			$keyed_submission_values = $submission->form_submission_values->keyBy('form_field_id');
		endif;
		
		// Return template
		$response = $this->container->get('view')->render($response, "form_display.php", ['page_title' => 'Display Form',
																																											'form' => $form,
																																											'submission' => $submission,
																																											'keyed_submission_values' => $keyed_submission_values,
																																											'route' => $uri->getPath()
			]);
		return $response;
	}
	
	/**
	 * Process form submission. Validate and save valid input. Upon success, redirect.
	 * 
	 * @param \Slim\Http\Request $request PSR-7 Request
	 * @param \Slim\Http\Response $response PSR-7 Response
	 * @param array $args Named placeholders from the URL
	 */
	public function processFormSubmission(Request $request, Response $response, $args)
	{
		// Get submitted data
		$data = $request->getParsedBody();
		
		// If applicable, get form id from query string
		$submission_id = $request->getQueryParam('submission_id');
		
		// Connect to ORM
		$this->container->get('orm');
		
		// If submission_id present, setup form submission object from an existing model in the database
		if ($data['submission_id']) :
			$form_submission = \IFS\Models\FormSubmission::findOrFail((int)$data['submission_id']);
		// Else, setup a new form submission object
		else :
			$form_submission = new \IFS\Models\FormSubmission;
			$form_submission->form_id = (int)$args['id'];
		endif;
		
		// Persist in database
		$form_submission->save();
		
		// Delete previous submission values before storing new ones
		$form_submission->form_submission_values()->delete();
		
		// Aggregate input values (i.e. elements with an form_field_id)
		$users_submission = [];
		foreach ($data as $form_field => $value) :
			if (strpos($form_field, 'form_field_id_') !== false) :
				
				// Get form field ID
				preg_match('/form_field_id_([0-9]+)(_option_id_){0,1}([0-9]+)*/', $form_field, $matches);
				$form_field_id = $matches[1];
				
				// Get option if applicable
				$form_field_option_id = null;
				if (strpos($matches[0], 'option_id') !== false) :
					$form_field_option_id = $matches[3];
					$form_field_option = \IFS\Models\FormFieldOption::find($form_field_option_id);
				endif;
				
				if (!$form_field_option_id) :
					$users_submission[$form_field_id] = $value;
				else :
					$users_submission[$form_field_id][$form_field_option->value] = $value;
				endif;
				
			endif;
		endforeach;
		
		// Instantiate model for each submission value
		foreach ($users_submission as $form_field_id => $form_submission_value) :
			$form_submission_values[] = new \IFS\Models\FormSubmissionValue(['form_field_id' => $form_field_id, 'value' => json_encode($form_submission_value)]);
		endforeach;
		
		// Persist in database
		$form_submission->form_submission_values()->saveMany($form_submission_values);
		
		// Redirect to home
		redirect_to('/submissions/?form_id=' . (int)$args['id']);		
	}
	
}

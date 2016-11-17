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
		$form = \IFS\Models\CustomForm::with(['form_elements' => function($query)
								{
									$query->orderBy('order', 'asc');
								}])
								->findOrFail((int)$args['id']);
								
		// Get URI object for route to be passed to template
		$uri = $request->getUri();
		
		// If applicable, get submission id from query string
		$submission_id = $request->getQueryParam('submission_id');
		
		// If applicable, get previous submission
		$submission = null;
		$keyed_submission_values = null;
		if ($submission_id) :
			$submission = \IFS\Models\FormSubmission::with('form_submission_values')->findOrFail((int)$submission_id);
			$keyed_submission_values = $submission->form_submission_values->keyBy('form_element_id');
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
		
		echo '<pre>';
		print_r($data);
		echo '</pre>';
		
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
		
		// Aggregate input values (i.e. elements with an form_element_id)
		foreach ($data as $form_element => $value) :
			if (strpos($form_element, 'form_element_id_') !== false) :
				
				// Get form element ID
				preg_match('/form_element_id_([0-9]+)[[:graph:]]*/', $form_element, $matches);
				$form_element_id = $matches[1];
				
				// Convert value to a JSON string that can be stored in database
				$value_json = json_encode($value);
			
				// Instantiate model for each submission value
				$submission_values[] = new \IFS\Models\FormSubmissionValue(['form_element_id' => $form_element_id, 'value' => $value_json]);
				
			endif;
		endforeach;
		echo '<pre>';
		print_r($submission_values);
		echo '</pre>';
		exit('-exit-');
		exit('-exit-');
		
		// Persist in database
		$form_submission->form_submission_values()->saveMany($submission_values);
		
		// Redirect to home
		redirect_to('/submissions/?form_id=' . (int)$args['id']);		
	}
	
}

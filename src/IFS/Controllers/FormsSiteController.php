<?php
/**
 * Site controller for main forms home.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Controllers;

use \Slim\Container;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class FormsSiteController {
    
	/** @var array Application dependency container */
	private $container;

	/**
	 * Inject dependency container upon instantiation.
	 * 
	 * @param \Slim\Container $c Dependency container
	 * @return void
	 */
	public function __construct(Container $c)
	{
			$this->container = $c;
	}
	
	/**
	 * The home of the site.
	 * 
	 * @param \Slim\Http\Request $request PSR-7 Request
	 * @param \Slim\Http\Response $response PSR-7 Response
	 * @return \Slim\Http\Response $response PSR-7 Response
	 */
	public function showHome(Request $request, Response $response)
	{
		// Get forms
		$this->container->get('orm');
		$all_forms = \IFS\Models\CustomForm::all();
		
		// Return template
		$response = $this->container->get('view')->render($response, "forms_home.php", ['page_title' => 'Forms Home',
																																										'all_forms' => $all_forms]);
		return $response;
	}
	
	/**
	 * Form builder.
	 * 
	 * @param \Slim\Http\Request $request PSR-7 Request
	 * @param \Slim\Http\Response $response PSR-7 Response
	 * @param array $args Named placeholders from the URL
	 * @return \Slim\Http\Response $response PSR-7 Response
	 */
	public function showBuilder(Request $request, Response $response, array $args)
	{
		// Get form if applicable
		$form = null;
		if (!empty($args)) :
			$this->container->get('orm');
			$form = \IFS\Models\CustomForm::with(['form_elements.form_element_options'])
								->findOrFail((int)$args['id']);
		endif;
		
		// Initialize builder data
		$form_data = \IFS\Models\CustomForm::initBuilderVars($form);
		
		// Get URI object for route to be passed to template
		$uri = $request->getUri();
		
		// Return template
		$response = $this->container->get('view')->render($response, "form_builder.php", ['page_title' => 'Form Builder',
																																											'route' => $uri->getPath(),
																																											'form' => $form_data,
																																											'global_vars' => $this->container->get('global_vars')
			]);
		return $response;
	}
	
	/**
	 * Process form builder submission. Validate and save valid input. Upon success, redirect home.
	 * 
	 * @param \Slim\Http\Request $request PSR-7 Request
	 * @param \Slim\Http\Response $response PSR-7 Response
	 * @param array $args Named placeholders from the URL
	 */
	public function processBuilderSubmission(Request $request, Response $response, $args)
	{
		// Get submitted data
		$data = $request->getParsedBody();
		
		// Connect to ORM
		$this->container->get('orm');
		
		// If URL param present, setup form object from an existing model in the database
		if (!empty($args)) :
			$form = \IFS\Models\CustomForm::findOrFail((int)$args['id']);
		// Else, setup a new form object
		else :
			$form = new \IFS\Models\CustomForm;
			$form->name = $data['name'];
		endif;
		
		// Persist in database
		$form->save();
    
		// Update form elements associated with form
		
			// Get user's submission
			$form_elements = json_decode($data['form_elements']);
			
			// Store form element IDs. Used to determine what elements have been removed.
			foreach ($form_elements as $form_element) :
				$form_element_ids[] = $form_element->id;
			endforeach;
			
			// Delete any elements that have been removed. Must come before adds/updates.
			$form->form_elements()->whereNotIn('form_element_id', $form_element_ids)->delete();
		
			// Loop through each element in submission
			foreach ($form_elements as $form_element) :

				// If there is an ID, setup a form element object from an existing model in the database
				if ($form_element->id) :
					$tmpFormElement = \IFS\Models\FormElement::findOrFail($form_element->id);
				// Else, setup a new form element object
				else :
					$tmpFormElement = new \IFS\Models\FormElement;
				endif;
		
				// Update form element object with user submission
				$tmpFormElement->type = $form_element->type;
				$tmpFormElement->label = $form_element->label;
				$tmpFormElement->order = $form_element->order;
				$tmpFormElement->required = $form_element->required;
				$tmpFormElement->guidelines = $form_element->guidelines;
				$tmpFormElement->default_value = $form_element->default_value;
						
				// Persist in database
				$form->form_elements()->save($tmpFormElement);
				
				// Delete any existing element options
				$tmpFormElement->form_element_options()->delete();

				// If applicable, create new options with the user's submission
				if ($form_element->options) :
					$options = null;
					foreach (explode(",", $form_element->options) as $option) :
						$options[] = ['name' => $option];
					endforeach;
					$tmpFormElement->form_element_options()->createMany($options);
				endif;
						
				// Persist in database
				$form->form_elements()->save($tmpFormElement);

			endforeach;
				
		// Redirect to home
		redirect_to('/');
		
	}
	
	/**
	 * Delete form and redirect.
	 * 
	 * @param \Slim\Http\Request $request PSR-7 Request
	 * @param \Slim\Http\Response $response PSR-7 Response
	 * @param array $args Named placeholders from the URL
	 */
	public function deleteForm(Request $request, Response $response, $args)
	{
		// Connect to ORM
		$this->container->get('orm');
		
		// Delete form
		\IFS\Models\CustomForm::destroy($args['id']);
		
		// Redirect to home
		redirect_to('/');
	}
	
	/**
	 * Deactivate form.
	 * 
	 * @param \Slim\Http\Request $request PSR-7 Request
	 * @param \Slim\Http\Response $response PSR-7 Response
	 */
	public function deactivateForm(Request $request, Response $response)
	{
	
	}
	
	/**
	 * Activate form.
	 * 
	 * @param \Slim\Http\Request $request PSR-7 Request
	 * @param \Slim\Http\Response $response PSR-7 Response
	 */
	public function activateForm(Request $request, Response $response)
	{
		
	}
	
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
		
		// Aggregate input values (i.e. elements with an form_element_id)
		foreach ($data as $form_element => $value) :
			if (strpos($form_element, 'form_element_id_') !== false) :
				
				// Get form element ID
				$form_element_id = str_replace('form_element_id_', '', $form_element);
				
				// If applicable, convert value to a string that can be stored in database
				$value = (is_array($value)) ? implode(',', $value) : $value;
			
				// Instantiate model for each submission value
				if ($data['submission_id']) :
					$tmpFormSubmissionValue = \IFS\Models\FormSubmissionValue::where([
						['submission_id', '=', $data['submission_id']],
						['form_element_id', '=', $form_element_id]])->firstOrFail();
					$tmpFormSubmissionValue->value = $value;
					$submission_values[] = $tmpFormSubmissionValue;
				else :
					$submission_values[] = new \IFS\Models\FormSubmissionValue(['form_element_id' => $form_element_id, 'value' => $value]);
				endif;
				
			endif;
		endforeach;
		
		// Persist in database
		$form_submission->form_submission_values()->saveMany($submission_values);
		
		// Redirect to home
		redirect_to('/submissions/?form_id=' . (int)$args['id']);		
	}
	
	/**
	 * Show submissions associated with a specific form.
	 * 
	 * @param \Slim\Http\Request $request PSR-7 Request
	 * @param \Slim\Http\Response $response PSR-7 Response
	 * @param int $form_id Expected query string parameter
	 * @return \Slim\Http\Response $response PSR-7 Response
	 */
	public function showSubmissions(Request $request, Response $response)
	{	
		// Get form id from query string
		$form_id = $request->getQueryParam('form_id');
		
		// Connect to ORM
		$this->container->get('orm');
		
		// Query submissions
		$form = \IFS\Models\CustomForm::find($form_id);
		$submissions = $form->form_submissions;
		
		// Return template
		$response = $this->container->get('view')->render($response, "form_submissions.php", ['page_title' => 'Form Submissions',
																																													'form' => $form,
																																													'submissions' => $submissions
				]);
		return $response;
	}
	
}

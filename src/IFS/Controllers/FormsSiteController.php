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
			$form = \IFS\Models\CustomForm::with(['form_elements' => function($query)
								{
									$query->orderBy('order', 'asc');
								}])
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
		$parsedBody = $request->getParsedBody();
		
		// Connect to ORM
		$this->container->get('orm');
		
		// If URL param present, setup form object from an existing model in the database
		if (!empty($args)) :
			$form = \IFS\Models\CustomForm::findOrFail((int)$args['id']);
		// Else, setup a new form object
		else :
			$form = new \IFS\Models\CustomForm;
		endif;
		
		// Update form object with user submission and save
		$form->name = $parsedBody['name'];
		$form->save();
    
		// Update form elements associated with form
		
			// Get user's submission
			$form_elements = json_decode($parsedBody['form_elements']);
			
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
					$tmpFormElement = \IFS\Models\FormElement::find($form_element->id);
				// Else, setup a new form element object
				else :
					$tmpFormElement = new \IFS\Models\FormElement;
				endif;
		
				// Update form element object with user submission and save
				$tmpFormElement->type = $form_element->type;
				$tmpFormElement->label = $form_element->label;
				$tmpFormElement->order = $form_element->order;
				$tmpFormElement->required = $form_element->required;
				$tmpFormElement->guidelines = $form_element->guidelines;
				$tmpFormElement->default_value = $form_element->default_value;
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
	 * Display custom form. Suitable for user input.
	 * 
	 * @param \Slim\Http\Request $request PSR-7 Request
	 * @param \Slim\Http\Response $response PSR-7 Response
	 * @param array $args Named placeholders from the URL
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
		
		// Return template
		$response = $this->container->get('view')->render($response, "form_display.php", ['page_title' => 'Display Form',
																																											'form' => $form,
																																											'route' => $uri->getPath()
			]);
		return $response;
	}
	
	/**
	 * Show submissions associated with a specific form.
	 * 
	 * @param \Slim\Http\Request $request PSR-7 Request
	 * @param \Slim\Http\Response $response PSR-7 Response
	 * @param array $args Named placeholders from the URL
	 * @return \Slim\Http\Response $response PSR-7 Response
	 */
	public function showSubmissions(Request $request, Response $response, array $args)
	{	
		// Return template
		$response = $this->container->get('view')->render($response, "form_submissions.php", ['page_title' => 'Form Submissions']);
		return $response;
	}
	
}

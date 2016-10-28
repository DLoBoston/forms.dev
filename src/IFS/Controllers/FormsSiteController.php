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
	public function showBuilder(Request $request, Response $response, $args)
	{
		// Get form if applicable
		$form = null;
		if (!empty($args)) :
			$this->container->get('orm');
			$form = \IFS\Models\CustomForm::findOrFail((int)$args['id']);
		endif;
		
		// Initialize builder vars
		$form_data = \IFS\Models\CustomForm::initBuilderVars($form);
		
		// Get URI object for route to be passed to template
		$uri = $request->getUri();
		
		// Return template
		$response = $this->container->get('view')->render($response, "form_builder.php", ['page_title' => 'Form Builder',
																																											'route' => $uri->getPath(),
																																											'form' => $form
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
		
		// Setup form object
		if (empty($args)) :
			$form = new \IFS\Models\CustomForm;
		else :
			$form = \IFS\Models\CustomForm::findOrFail((int)$args['id']);
		endif;
		
		// Update form object with user submission and save
		$form->name = $parsedBody['name'];
		$form->save();
		
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
	
}

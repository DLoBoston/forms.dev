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
	public function showHome(Request $request, Response $response) {
		$response = $this->container->get('view')->render($response, "forms_home.php", ['page_title' => 'Forms Home']);
		return $response;
	}
	
    /**
     * Form builder.
     * 
     * @param \Slim\Http\Request $request PSR-7 Request
     * @param \Slim\Http\Response $response PSR-7 Response
     * @return \Slim\Http\Response $response PSR-7 Response
     */
	public function showBuilder(Request $request, Response $response) {
		$response = $this->container->get('view')->render($response, "form_builder.php", ['page_title' => 'Form Builder']);
		return $response;
	}
	
    /**
     * Delete form.
     * 
     * @param \Slim\Http\Request $request PSR-7 Request
     * @param \Slim\Http\Response $response PSR-7 Response
     */
	public function deleteForm(Request $request, Response $response) {
		
	}
	
    /**
     * Disable form.
     * 
     * @param \Slim\Http\Request $request PSR-7 Request
     * @param \Slim\Http\Response $response PSR-7 Response
     */
	public function disableForm(Request $request, Response $response) {
	
	}
	
    /**
     * Enable form.
     * 
     * @param \Slim\Http\Request $request PSR-7 Request
     * @param \Slim\Http\Response $response PSR-7 Response
     */
	public function enableForm(Request $request, Response $response) {
		
	}
	
    /**
     * Process form builder submission.
     * 
     * @param \Slim\Http\Request $request PSR-7 Request
     * @param \Slim\Http\Response $response PSR-7 Response
     */
	public function processBuilderSubmission(Request $request, Response $response) {
		
	}
	
}

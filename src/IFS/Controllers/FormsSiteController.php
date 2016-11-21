<?php
/**
 * Site controller for main forms home.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

/**
 * Site controller for main forms home.
 */
class FormsSiteController extends Controller
{
	
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
		$all_forms = \IFS\Models\Form::all();
		
		// Return template
		$response = $this->container->get('view')->render($response, "forms_home.php", ['page_title' => 'Forms Home',
																																										'all_forms' => $all_forms]);
		return $response;
	}
	
}

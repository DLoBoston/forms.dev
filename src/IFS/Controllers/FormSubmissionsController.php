<?php
/**
 * Controller for form submissions.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

/**
 * Controller for form submissions.
 */
class FormSubmissionsController extends Controller
{
	
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

<?php
/**
 * Site controller for API.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

/**
 * Site controller for API.
 */
class ApiController extends Controller
{
	
	/**
	 * Retrieve submission data.
	 * 
	 * @param \Slim\Http\Request $request PSR-7 Request
	 * @param \Slim\Http\Response $response PSR-7 Response
	 * @param array $args Named placeholders from the URL
	 * @return json	$response JSON encoded submission data.
	 */
	public function getSubmission(Request $request, Response $response, array $args)
	{
		// Get data from database
		$this->container->get('orm');
		$raw_submission = \IFS\Models\FormSubmission::with('form_submission_values')->findOrFail((int)$args['id']);
		$raw_keyed_submission_values = $raw_submission->form_submission_values->keyBy(function ($item) {
			$element_label = \IFS\Models\FormElement::where('form_element_id', $item['form_element_id'])->value('label');
			return $element_label;
		});
		
		// Format data for response
		$submission_values = [];
		foreach($raw_keyed_submission_values as $key => $value) :
			$submission_values[$key] = unserialize($value->serialized_value);
		endforeach;
		$submission = [
				'form_id' => $raw_submission['form_id'],
				'submission_id' => $raw_submission['submission_id'],
				'responses' => $submission_values
		];
		
		// Return JSON with status
		return $response->withJson($submission, 201);
	}
}

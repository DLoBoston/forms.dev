<?php
/**
 * Controller for form builder.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

/**
 * Controller for form builder.
 */
class FormBuilderController extends Controller
{	
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
		endif;
		
		// Update name and persist in database
		$form->name = $data['name'];
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
						$options[] = ['value' => $option];
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
	
}

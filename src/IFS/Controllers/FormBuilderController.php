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
			$form = \IFS\Models\Form::with(['form_fields.form_field_options'])
								->findOrFail((int)$args['id']);
		endif;
		
		// Initialize builder data
		$form_data = \IFS\Models\Form::initBuilderVars($form);
		
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
			$form = \IFS\Models\Form::findOrFail((int)$args['id']);
		// Else, setup a new form object
		else :
			$form = new \IFS\Models\Form;
		endif;
		
		// Update name and persist in database
		$form->name = $data['name'];
		$form->save();
    
		// Update form fields associated with form
		
			// Get user's submission
			$form_fields = json_decode($data['form_fields']);
			
			// Store form field IDs. Used to determine what fields have been removed.
			foreach ($form_fields as $form_field) :
				$form_field_ids[] = $form_field->id;
			endforeach;
			
			// Delete any fields that have been removed. Must come before adds/updates.
			$form->form_fields()->whereNotIn('form_field_id', $form_field_ids)->delete();
		
			// Loop through each field in submission
			foreach ($form_fields as $form_field) :

				// If there is an ID, setup a form field object from an existing model in the database
				if ($form_field->id) :
					$tmpFormField = \IFS\Models\FormField::findOrFail($form_field->id);
				// Else, setup a new form field object
				else :
					$tmpFormField = new \IFS\Models\FormField;
				endif;
		
				// Update form field object with user submission
				$tmpFormField->type = $form_field->type;
				$tmpFormField->label = $form_field->label;
				$tmpFormField->order = $form_field->order;
				$tmpFormField->required = $form_field->required;
				$tmpFormField->guidelines = $form_field->guidelines;
				$tmpFormField->default_value = $form_field->default_value;
						
				// Persist in database
				$form->form_fields()->save($tmpFormField);
				
				// Delete any existing field options
				$tmpFormField->form_field_options()->delete();

				// If applicable, create new options with the user's submission
				if ($form_field->options) :
					$options = null;
					foreach (explode(",", $form_field->options) as $option) :
						$options[] = ['value' => $option];
					endforeach;
					$tmpFormField->form_field_options()->createMany($options);
				endif;
						
				// Persist in database
				$form->form_fields()->save($tmpFormField);

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
		\IFS\Models\Form::destroy($args['id']);
		
		// Redirect to home
		redirect_to('/');
	}
	
}

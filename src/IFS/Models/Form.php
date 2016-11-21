<?php
/**
 * Custom form model.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Models interaction with custom_form entity in persistent data.
 * Forms are a set of fields to collect input for a specific purpose.
 */
class Form extends Model
{
	/**
	 * Eloquent function to get the sections for a specific form.
	 */
	public function form_sections()
	{
			return $this->hasMany('IFS\Models\FormSection');
	}
	
	/**
	 * Eloquent function to get the form submissions for a specific form.
	 */
	public function form_submissions()
	{
			return $this->hasMany('IFS\Models\FormSubmission');
	}
	
	/** @todo Refactor out the initBuilderVars method to another class so that
	 * this class can focus on just being a persist table representation.
	 */
	/**
	 * Initializes the vars for form display in Builder. Overwrite with optionally passed in data.
	 * 
	 * @param \IFS\Models\Form $form Custom form.
	 * @return array $data Initialized data to populate the form fields
	 */
	public static function initBuilderVars($form = null)
	{
		// Initialize form vars
		$data = [
				'form_id' => null,
				'name' => '',
				'elements' => null
			];
			
		// Overwrite with existing form model if applicable
		if (!empty($form)) :
			$data = [
					'form_id' => $form->id,
					'name' => $form->name,
					'elements' => $form->form_elements->sortBy('order')->values()
				];
		endif;

		return $data;
	}
	
}

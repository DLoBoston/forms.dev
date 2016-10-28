<?php
/**
 * Custom form model.
 * @author Digital D.Lo <WebDevDLo@gmaiil.com>
 */
namespace IFS\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Models interaction with custom_form entity in persistent data.
 * Forms are a set of fields to collect input for a specific purpose.
 */
class CustomForm extends Model
{
	/** @var string Overrides ID assumed by Eloquent */
	protected $primaryKey = 'form_id';
	
	/**
	 * Get the form elements for a specific form.
	 */
	public function form_elements()
	{
			return $this->hasMany('IFS\Models\FormElement', 'form_id');
	}
	
	/**
	 * Initializes the vars for form display in Builder. Overwrite with optionally passed in data.
	 * 
	 * @param \IFS\Models\CustomForm $form Custom form.
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
					'form_id' => $form->form_id,
					'name' => $form->name,
					'elements' => $form->form_elements
				];
		endif;

		return $data;
	}
	
}

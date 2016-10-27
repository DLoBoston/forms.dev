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
	 * Initializes the vars for form display. Overwrite with optionally passed in data.
	 * 
	 * @param \IFS\Models\CustomForm $form Custom form.
	 * @return array $data Initialized data to populate the form fields
	 */
	public static function initFormVars($form = null)
	{
		// Initialize form vars
		$data = [
				'form_id' => null,
				'name' => ''
			];
		
		// Overwrite with existing form model if applicable
		if (!empty($form)) :
			$data = [
					'form_id' => $form->form_id,
					'name' => $form->name
				];
		endif;

		return $data;
	}
	
}

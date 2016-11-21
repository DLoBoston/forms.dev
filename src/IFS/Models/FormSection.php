<?php
/**
 * Model of form section.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Models interaction with form_sections entity in persistent data.
 * Form elements are fields on a form.
 */
class FormSection extends Model
{
	/**
	 * Eloquent function to get the form elements associated with a section.
	 */
	public function form_elements()
	{
			return $this->hasMany('IFS\Models\FormElement');
	}
	
}

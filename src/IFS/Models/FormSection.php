<?php
/**
 * Model of form section.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Models interaction with form_sections entity in persistent data.
 * Form Fields are fields on a form.
 */
class FormSection extends Model
{
	/**
	 * Eloquent function to get the form fields associated with a section.
	 */
	public function form_fields()
	{
			return $this->hasMany('IFS\Models\FormField');
	}
	
}

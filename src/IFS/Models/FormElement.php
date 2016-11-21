<?php
/**
 * Model of form fields.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Models interaction with form_elements entity in persistent data.
 * Form elements are fields on a form.
 */
class FormElement extends Model
{
	/**
	 * Eloquent convention - All of the relationships to be touched.
	 *
	 * @var array
	 */
	protected $touches = ['custom_form'];
	
	/**
	 * Eloquent convention - Get the form that this element belongs to.
	 */
	public function custom_form()
	{
			return $this->belongsTo('IFS\Models\Form');
	}
	
	/**
	 * Eloquent function to get the options for a specific element.
	 */
	public function form_element_options()
	{
			return $this->hasMany('IFS\Models\FormElementOption');
	}
	
}

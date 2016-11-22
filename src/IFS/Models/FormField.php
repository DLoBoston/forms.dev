<?php
/**
 * Model of form fields.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Models interaction with form_fields entity in persistent data.
 */
class FormField extends Model
{
	/**
	 * Eloquent convention - All of the relationships to be touched.
	 *
	 * @var array
	 */
	protected $touches = ['form'];
	
	/**
	 * Eloquent convention - Get the form that this field belongs to.
	 */
	public function form()
	{
			return $this->belongsTo('IFS\Models\Form');
	}
	
	/**
	 * Eloquent function to get the options for a specific field.
	 */
	public function form_field_options()
	{
			return $this->hasMany('IFS\Models\FormFieldOption');
	}
	
}

<?php
/**
 * Model of form field option.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Models interaction with form_element_options entity in persistent data.
 * Options are used on fields like radio buttons and checkboxes.
 */
class FormElementOption extends Model
{
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['value'];
	
	/**
	 * Eloquent convention - All of the relationships to be touched.
	 *
	 * @var array
	 */
	protected $touches = ['form_element'];
	
	/**
	 * Eloquent convention - Get the form element that this option belongs to.
	 */
	public function form_element()
	{
			return $this->belongsTo('IFS\Models\FormElement', 'form_element_id', 'form_element_id');
	}
	
}

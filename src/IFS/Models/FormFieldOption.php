<?php
/**
 * Model of form field option.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Models interaction with form_field_options entity in persistent data.
 * Options are used on fields like radio buttons and checkboxes.
 */
class FormFieldOption extends Model
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
	protected $touches = ['form_field'];
	
	/**
	 * Eloquent convention - Get the form field that this option belongs to.
	 */
	public function form_field()
	{
			return $this->belongsTo('IFS\Models\FormField');
	}
	
}

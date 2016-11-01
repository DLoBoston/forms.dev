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
  /** @var string Overrides ID assumed by Eloquent */
  protected $primaryKey = 'form_element_id';
	
	/**
	 * Factory to create appropriate html element based on passed in type.
	 * 
	 * @param string $type
	 * @return \IFS\Models\TextAreaElement|\IFS\Models\TextElement
	 */
	public static function makeElement($type)
	{
		switch ($type) {
			case 'radio':
				return new RadioElement();
				break;
			case 'checkbox':
				return new CheckboxElement();
				break;
			case 'select':
				return new SelectElement();
				break;
			case 'textarea':
				return new TextAreaElement();
				break;
			case 'text':
			default:
				return new TextElement();
				break;
		}
	}
  
}

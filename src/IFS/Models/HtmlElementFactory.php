<?php
/**
 * Factory to create appropriate html element based on user-defined form field.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models;

use IFS\Models\FormFieldDecorators\RadioInput;
use IFS\Models\FormFieldDecorators\CheckboxInput;
use IFS\Models\FormFieldDecorators\TextInput;
use IFS\Models\FormFieldDecorators\HiddenInput;
use IFS\Models\FormFieldDecorators\TextAreaInput;
use IFS\Models\FormFieldDecorators\SelectElement;
use IFS\Models\FormFieldDecorators\MatrixRadioInput;
use IFS\Models\FormFieldDecorators\MatrixCheckboxInput;

/**
 * Factory to create appropriate html element based on user-defined form field.
 */
abstract class HtmlElementFactory
{
	
	/**
	 * Factory to create appropriate html element based on user-defined form field.
	 * 
	 * @param \IFS\Models\FormField $generic_form_field User-defined form field.
	 * @return \IFS\Models\FormFieldDecorators\TextInput|
	 *				 \IFS\Models\FormFieldDecorators\HiddenInput|
	 *				 \IFS\Models\FormFieldDecorators\TextAreaInput|
	 *				 \IFS\Models\FormFieldDecorators\RadioInput|
	 *				 \IFS\Models\FormFieldDecorators\CheckboxInput|
	 *				 \IFS\Models\FormFieldDecorators\SelectElement|
	 *				 \IFS\Models\FormFieldDecorators\MatrixRadioInput|
	 *				 \IFS\Models\FormFieldDecorators\MatrixCheckboxInput
	 */
	public static function create(\IFS\Models\FormField $generic_form_field)
	{
		switch ($generic_form_field->type) {
			case 'matrix-radio':
				return new MatrixRadioInput($generic_form_field);
				break;
			case 'matrix-checkbox':
				return new MatrixCheckboxInput($generic_form_field);
				break;
			case 'radio':
				return new RadioInput($generic_form_field);
				break;
			case 'checkbox':
				return new CheckboxInput($generic_form_field);
				break;
			case 'select':
			case 'select-multiple':
				return new SelectElement($generic_form_field);
				break;
			case 'hidden_field':
				return new HiddenInput($generic_form_field);
				break;
			case 'textarea':
				return new TextAreaInput($generic_form_field);
				break;
			case 'single_line_text':
			default:
				return new TextInput($generic_form_field);
				break;
		}
	}
  
}

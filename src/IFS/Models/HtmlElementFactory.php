<?php
/**
 * Factory to create appropriate html element based on user-defined form element.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models;

use IFS\Models\FormElementDecorators\RadioElement;
use IFS\Models\FormElementDecorators\CheckboxElement;
use IFS\Models\FormElementDecorators\TextElement;
use IFS\Models\FormElementDecorators\HiddenElement;
use IFS\Models\FormElementDecorators\TextAreaElement;
use IFS\Models\FormElementDecorators\SelectElement;
use IFS\Models\FormElementDecorators\MatrixRadioElement;

/**
 * Factory to create appropriate html element based on user-defined form element.
 */
abstract class HtmlElementFactory
{
	
	/**
	 * Factory to create appropriate html element based on user-defined form element.
	 * 
	 * @param \IFS\Models\FormElement $generic_form_element User-defined form element.
	 * @return \IFS\Models\FormElementDecorators\TextElement|
	 *				 \IFS\Models\FormElementDecorators\HiddenElement|
	 *				 \IFS\Models\FormElementDecorators\TextAreaElement|
	 *				 \IFS\Models\FormElementDecorators\RadioElement|
	 *				 \IFS\Models\FormElementDecorators\CheckboxElement|
	 *				 \IFS\Models\FormElementDecorators\SelectElement|
	 *				 \IFS\Models\FormElementDecorators\MatrixRadioElement
	 */
	public static function create(\IFS\Models\FormElement $generic_form_element)
	{
		switch ($generic_form_element->type) {
			case 'matrix-radio':
				return new MatrixRadioElement($generic_form_element);
				break;
			case 'radio':
				return new RadioElement($generic_form_element);
				break;
			case 'checkbox':
				return new CheckboxElement($generic_form_element);
				break;
			case 'select':
			case 'select-multiple':
				return new SelectElement($generic_form_element);
				break;
			case 'hidden_field':
				return new HiddenElement($generic_form_element);
				break;
			case 'textarea':
				return new TextAreaElement($generic_form_element);
				break;
			case 'single_line_text':
			default:
				return new TextElement($generic_form_element);
				break;
		}
	}
  
}

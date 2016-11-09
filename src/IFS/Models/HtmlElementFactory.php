<?php
/**
 * Factory to create appropriate html element based on user-defined form element.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models;

/**
 * Factory to create appropriate html element based on user-defined form element.
 */
abstract class HtmlElementFactory
{
	
	/**
	 * Factory to create appropriate html element based on user-defined form element.
	 * 
	 * @param \IFS\Models\FormElement $generic_form_element User-defined form element.
	 * @return \IFS\Models\TextElement|
	 *				 \TextAreaElement|
	 *				 \IFS\Models\RadioElement|
	 *				 \IFS\Models\CheckboxElement|
	 *				 \IFS\Models\SelectElement
	 */
	public static function create(\IFS\Models\FormElement $generic_form_element)
	{
		switch ($generic_form_element->type) {
			case 'radio':
				return new RadioElement($generic_form_element);
				break;
			case 'checkbox':
				return new CheckboxElement($generic_form_element);
				break;
			case 'select':
				return new SelectElement($generic_form_element);
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

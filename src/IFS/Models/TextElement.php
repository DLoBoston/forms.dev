<?php
/**
 * Model of text input form field.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models;

/**
 * Model of text input form field.
 */
class TextElement extends FormElement
{
	/**
	 * Returns HTML for text input.
	 * 
	 * @param \IFS\Models\FormElement $element Generic form element representation
	 * of a user-specified form element associated with a specific form.
	 * @return string
	 */
	public function getHtml($element)
	{
		$html =		'<label for="form_element_' . $element->form_element_id . '">' . $element->label . '</label>' . PHP_EOL
						. '<input id="form_element_' . $element->form_element_id . '" type="text" name="" value="">';
		return $html;
	}
}

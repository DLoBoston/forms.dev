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
		$html =		'<label>' . $element->label . '</label> .'
						. '<input type="text" name="" value="">';
		return $html;
	}
}

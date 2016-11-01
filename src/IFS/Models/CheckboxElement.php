<?php
/**
 * Model of checkbox input form field.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models;

/**
 * Model of checkbox input form field.
 */
class CheckboxElement extends FormElement
{
	/**
	 * Returns HTML for checkbox input.
	 * 
	 * @param \IFS\Models\FormElement $element Generic form element representation
	 * of a user-specified form element associated with a specific form.
	 * @return string
	 */
	public function getHtml($element)
	{
		$html =		'<p>' . $element->label . '</p>'
						.	'<label>'
						.		'<input type="checkbox" name="" value="">'
						. '</label>';
		return $html;
	}
}

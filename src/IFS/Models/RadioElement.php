<?php
/**
 * Model of radio input form field.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models;

/**
 * Model of radio input form field.
 */
class RadioElement extends FormElement
{
	/**
	 * Returns HTML for radio input.
	 * 
	 * @param \IFS\Models\FormElement $element Generic form element representation
	 * of a user-specified form element associated with a specific form.
	 * @return string
	 */
	public function getHtml($element)
	{
		$html =		'<p>' . $element->label . '</p>'
						.	'<label>'
						.		'<input type="radio" name="" value="">'
						. '</label>';
		return $html;
	}
}

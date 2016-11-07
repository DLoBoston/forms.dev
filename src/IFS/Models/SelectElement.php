<?php
/**
 * Model of select input form field.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models;

/**
 * Model of select input form field.
 */
class SelectElement extends FormElement
{
	/**
	 * Returns HTML for select input.
	 * 
	 * @param \IFS\Models\FormElement $element Generic form element representation
	 * of a user-specified form element associated with a specific form.
	 * @return string
	 */
	public function getHtml($element)
	{
		$html =		'<label>' . $element->label . '</label>' . PHP_EOL
						.	'<select>'
						.	'</select>';
		return $html;
	}
}

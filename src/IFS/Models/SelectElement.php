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
	 * @param string $value Element value
	 * @param IFS\Models\FormElementOption $options Element options
	 * @return string
	 */
	public function getHtml($value, $options)
	{
		$html =		'<label>' . $element->label . '</label>' . PHP_EOL
						.	'<select>'
						.	'</select>';
		return $html;
	}
}

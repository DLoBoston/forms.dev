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
	 * @param string $value Element value
	 * @param IFS\Models\FormElementOption $options Element options
	 * @return string
	 */
	public function getHtml($value, $options)
	{
		$html =		'<p>' . $element->label . '</p>'
						.	'<label>'
						.		'<input type="checkbox" name="" value="">'
						. '</label>';
		return $html;
	}
}

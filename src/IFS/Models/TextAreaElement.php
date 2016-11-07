<?php
/**
 * Model of textarea input form field.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models;

/**
 * Model of textarea input form field.
 */
class TextAreaElement extends FormElement
{
	/**
	 * Return HTML for textarea input.
	 * 
	 * @param \IFS\Models\FormElement $element Generic form element representation
	 * of a user-specified form element associated with a specific form.
	 * @return string
	 */
	public function getHtml($element)
	{
		$html =		'<label>' . $element->label . '</label>' . PHP_EOL
						. '<textarea></textarea>';
		return $html;
	}
}

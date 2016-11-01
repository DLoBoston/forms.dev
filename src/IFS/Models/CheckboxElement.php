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
	 * Return generic text input HTML.
	 * 
	 * @return string
	 */
	public function getHtml()
	{
		return '<input type="checkbox">';
	}
}

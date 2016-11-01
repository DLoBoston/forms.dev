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
	 * Return generic text input HTML.
	 * 
	 * @return string
	 */
	public function getHtml()
	{
		return '<input type="radio">';
	}
}

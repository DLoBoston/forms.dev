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
	 * Return generic text input HTML.
	 * 
	 * @return string
	 */
	public function getHtml()
	{
		return '<select></select>';
	}
}

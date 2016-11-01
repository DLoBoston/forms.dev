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
	 * Return generic text input HTML.
	 * 
	 * @return string
	 */
	public function getHtml()
	{
		return '<input type="text" name="" value="">';
	}
}

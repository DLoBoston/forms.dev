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
	 * Return generic text input HTML.
	 * 
	 * @return string
	 */
	public function getHtml()
	{
		return '<textarea></textarea>';
	}
}

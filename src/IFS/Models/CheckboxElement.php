<?php
/**
 * HTML checkbox input decorator for Form Element.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models;

/**
 * HTML checkbox input decorator for Form Element. Note decorators include a
 * reference to the element they are decorating.
 */
class CheckboxElement extends FormElementDecorator
{
	/**
	 * Returns HTML for checkbox input.
	 * 
	 * @param string $value Element value
	 * @return string
	 */
	public function getHtml($value)
	{
		$html =		'<p>' . $this->form_element->label . '</p>';
		foreach ($this->form_element->form_element_options as $option) :
			$html .=	'<label>' . $value
							.	' <input'
							.		' type="checkbox"'
							.		' value="' . $option->name . '"'
							.		' name="form_element_id_' . $this->form_element->form_element_id . '[]">'
							.		' ' . $option->name
							. '</label>' . PHP_EOL;
		endforeach;
		
		return $html;
	}
}

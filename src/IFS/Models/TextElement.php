<?php
/**
 * HTML text input decorator for Form Element.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models;

/**
 * HTML text input decorator for Form Element
 */
class TextElement extends FormElementDecorator
{	
	/**
	 * Returns HTML for text input.
	 * 
	 * @param string $value Optional element value
	 * @return string
	 */
	public function getHtml($value = null)
	{
		$html =		'<label for="form_element_id_' . $this->form_element->form_element_id . '">' . $this->form_element->label . '</label>' . PHP_EOL
						. '<input'
						.		' id="form_element_id_' . $this->form_element->form_element_id . '"'
						.		' type="text"'
						.		' value="' . $value . '"'
						.		' name="form_element_id_' . $this->form_element->form_element_id . '">';
		return $html;
	}
}

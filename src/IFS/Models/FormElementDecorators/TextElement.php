<?php
/**
 * HTML text input decorator for Form Element.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models\FormElementDecorators;

/**
 * HTML text input decorator for Form Element. Note decorators include a
 * reference to the element they are decorating.
 */
class TextElement extends FormElementDecorator
{	
	/**
	 * Returns HTML for text input.
	 * 
	 * @param string $value PHP serialized encoded element value.
	 * @return string
	 */
	public function getHtml($value)
	{	
		// Unserialize value
		$value = unserialize($value);
		
		// Construct HTML
		$html =		'<label for="form_element_id_'
						.		$this->form_element->form_element_id . '">'
						.		(($this->form_element->required) ? '<span class="required">* </span>' : '')
						.		$this->form_element->label
						. '</label>' . PHP_EOL
						. '<input'
						.		' id="form_element_id_' . $this->form_element->form_element_id . '"'
						.		' type="text"'
						.		' value="' . $value . '"'
						.		' name="form_element_id_' . $this->form_element->form_element_id . '">';
		return $html;
	}
}

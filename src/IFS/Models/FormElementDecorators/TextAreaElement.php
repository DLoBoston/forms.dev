<?php
/**
 * HTML text input decorator for Form Element.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models\FormElementDecorators;

/**
 * HTML textarea input decorator for Form Element. Note decorators include a
 * reference to the element they are decorating.
 */
class TextAreaElement extends FormElementDecorator
{
	/**
	 * Returns HTML for textarea input.
	 * 
	 * @param string $value Element value
	 * @return string
	 */
	public function getHtml($value)
	{
		$html =		'<label for="form_element_id_'
						.		$this->form_element->form_element_id . '">'
						.		(($this->form_element->required) ? '<span class="required">* </span>' : '')
						.		$this->form_element->label
						. '</label>' . PHP_EOL
						. '<textarea'
						.		' id="form_element_id_' . $this->form_element->form_element_id . '"'
						.		' name="form_element_id_' . $this->form_element->form_element_id . '">'
						.		$value
						.	'</textarea>';
		return $html;
	}
}

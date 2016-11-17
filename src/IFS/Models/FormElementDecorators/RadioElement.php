<?php
/**
 * HTML radio input decorator for Form Element.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models\FormElementDecorators;

/**
 * HTML radio input decorator for Form Element. Note decorators include a
 * reference to the element they are decorating.
 */
class RadioElement extends FormElementDecorator
{
	/**
	 * Returns HTML for radio input.
	 * 
	 * @param string $value Element value
	 * @return string
	 */
	public function getHtml($value)
	{
		$html =		'<p>'
						.		(($this->form_element->required) ? '<span class="required">* </span>' : '')
						.		$this->form_element->label
						. '</p>';
		foreach ($this->form_element->form_element_options as $option) :
			$html .=	'<label>'
							.	' <input'
							.		' type="radio"'
							.		' value="' . $option->name . '"'
							.		(($option->name === $value) ? ' checked' : '')
							.		' name="form_element_id_' . $this->form_element->form_element_id . '">'
							.		' ' . $option->name
							. '</label>' . PHP_EOL;
		endforeach;
		
		return $html;
	}
}

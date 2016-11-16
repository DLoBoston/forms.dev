<?php
/**
 * HTML checkbox input decorator for Form Element.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models\FormElementDecorators;

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
		// If applicable, convert value to array
		$value = (($value) ? explode(',', $value) : $value);
		
		// Construct HTML + value
		$html =		'<p>'
						.		(($this->form_element->label) ? '<span class="required">* </span>' : '')
						.		$this->form_element->label
						. '</p>';
		foreach ($this->form_element->form_element_options as $option) :
			$html .=	'<label>'
							.	' <input'
							.		' type="checkbox"'
							.		' value="' . $option->name . '"'
							.		' data-required="' . $this->form_element->required . '"'
							.		(($value && array_search($option->name, $value) !== false) ? ' checked' : '')
							.		' name="form_element_id_' . $this->form_element->form_element_id . '[]">'
							.		' ' . $option->name
							. '</label>' . PHP_EOL;
		endforeach;
		
		return $html;
	}
}

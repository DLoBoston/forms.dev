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
	 * @param string $value PHP serialized element value.
	 * @return string
	 */
	public function getHtml($value)
	{	
		// Unserialize value
		$value = unserialize($value);
		
		// Construct HTML + value
		$html =		'<p>'
						.		(($this->form_element->required) ? '<span class="required">* </span>' : '')
						.		$this->form_element->label
						. '</p>';
		foreach ($this->form_element->form_element_options as $option) :
			$html .=	'<label>'
							.	' <input'
							.		' type="checkbox"'
							.		' value="' . $option->value . '"'
							.		(($value && array_search($option->value, $value) !== false) ? ' checked' : '')
							.		' name="form_element_id_' . $this->form_element->form_element_id . '[]">'
							.		' ' . $option->value
							. '</label>' . PHP_EOL;
		endforeach;
		
		return $html;
	}
}

<?php
/**
 * HTML select input decorator for Form Element.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models\FormElementDecorators;

/**
 * HTML select input decorator for Form Element. Note decorators include a
 * reference to the element they are decorating.
 */
class SelectElement extends FormElementDecorator
{
	/**
	 * Returns HTML for select input.
	 * 
	 * @param string $value Element value
	 * @return string
	 */
	public function getHtml($value)
	{
		// If applicable, convert value to array
		$value = (($value) ? explode(',', $value) : $value);
		
		// Construct HTML + value
		$html =		'<label for="form_element_id_'
						.		$this->form_element->form_element_id . '">'
						.		(($this->form_element->required) ? '<span class="required">* </span>' : '')
						.		$this->form_element->label
						. '</label>' . PHP_EOL
						. '<select'
						.		' id="form_element_id_' . $this->form_element->form_element_id . '"'
						.		(($this->form_element->type == 'select-multiple') ? ' multiple' : '')
						.		' data-required="' . $this->form_element->required . '"'
						.		' name="form_element_id_' . $this->form_element->form_element_id . '"'
						.		(($this->form_element->type == 'select-multiple') ? '[]' : '') . '">' . PHP_EOL
						.		'<option value="">Please select</option>' . PHP_EOL;
		foreach ($this->form_element->form_element_options as $option) :
			$html .=	'<option value="' . $option->name . '"'
						.			(($value && array_search($option->name, $value) !== false) ? ' selected' : '')
						.			'>'
						. $option->name. '</option>' . PHP_EOL;
		endforeach;
		$html .=	'</select>';
		
		return $html;
	}
}

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
		// If value is defined but not array, convert to array so that it can be
		// used below for select elements that are single and select-multiple.
		if ($value && !is_array($value)) :
			$value = array($value);
		endif;
		
		// Construct HTML
		$html =		'<label for="form_element_id_'
						.		$this->form_element->id . '">'
						.		(($this->form_element->required) ? '<span class="required">* </span>' : '')
						.		$this->form_element->label
						. '</label>' . PHP_EOL
						. '<select'
						.		' id="form_element_id_' . $this->form_element->id . '"'
						.		(($this->form_element->type == 'select-multiple') ? ' multiple' : '')
						.		' name="form_element_id_' . $this->form_element->id
						.		(($this->form_element->type == 'select-multiple') ? '[]' : '') . '">' . PHP_EOL
						.		'<option value="">Please select</option>' . PHP_EOL;
		foreach ($this->form_element->form_element_options as $option) :
			$html .=	'<option '
						.			'value="' . $option->value . '"'
						.			(($value && array_search($option->value, $value) !== false) ? ' selected' : '')
						.		'>'
						. $option->value. '</option>' . PHP_EOL;
		endforeach;
		$html .=	'</select>';
		
		return $html;
	}
}

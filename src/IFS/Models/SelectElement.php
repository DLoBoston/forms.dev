<?php
/**
 * HTML select input decorator for Form Element.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models;

/**
 * HTML select input decorator for Form Element.
 */
class SelectElement extends FormElementDecorator
{
	/**
	 * Returns HTML for select input.
	 * 
	 * @param string $value Element value
	 * @param IFS\Models\FormElementOption $options Element options
	 * @return string
	 */
	public function getHtml($value, $options)
	{
		$html =		'<label for="form_element_id_' . $this->form_element->form_element_id . '">' . $this->form_element->label . '</label>' . PHP_EOL
						. '<select'
						.		' id="form_element_id_' . $this->form_element->form_element_id . '"'
						.		(($this->form_element->type == 'select-multiple') ? ' multiple' : '')
						.		' name="form_element_id_' . $this->form_element->form_element_id
						.		(($this->form_element->type == 'select-multiple') ? '[]' : '') . '">';
		foreach ($options as $option) :
			$html .=	'<option value="' . $option->name . '">' . $option->name. '</option>' . PHP_EOL;
		endforeach;
		$html .=	'</select>';
		
		return $html;
	}
}

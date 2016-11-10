<?php
/**
 * HTML radio input decorator for Form Element.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models;

/**
 * HTML radio input decorator for Form Element.
 */
class RadioElement extends FormElementDecorator
{
	/**
	 * Returns HTML for radio input.
	 * 
	 * @param string $value Element value
	 * @param IFS\Models\FormElementOption $options Element options
	 * @return string
	 */
	public function getHtml($value, $options)
	{
		$html =		'<p>' . $this->form_element->label . '</p>';
		foreach ($options as $option) :
			$html .=	'<label>' . $value
							.	' <input'
							.		' type="radio"'
							.		' value="' . $option->name . '"'
							.		' name="form_element_id_' . $this->form_element->form_element_id . '">'
							.		' ' . $option->name
							. '</label>' . PHP_EOL;
		endforeach;
		
		return $html;
	}
}

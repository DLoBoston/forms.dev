<?php
/**
 * HTML radio input decorator for FormField.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models\FormFieldDecorators;

/**
 * HTML radio input decorator for FormField. Note decorators include a
 * reference to the field they are decorating.
 */
class RadioInput extends FormFieldDecorator
{
	/**
	 * Returns HTML for radio input.
	 * 
	 * @param string $value Field value
	 * @return string
	 */
	public function getHtml($value)
	{
		$html =		'<p>'
						.		(($this->form_field->required) ? '<span class="required">* </span>' : '')
						.		$this->form_field->label
						. '</p>';
		foreach ($this->form_field->form_field_options as $option) :
			$html .=	'<label>'
							.	' <input'
							.		' type="radio"'
							.		' value="' . $option->value . '"'
							.		(($option->value === $value) ? ' checked' : '')
							.		' name="form_field_id_' . $this->form_field->id . '">'
							.		' ' . $option->value
							. '</label>' . PHP_EOL;
		endforeach;
		
		return $html;
	}
}

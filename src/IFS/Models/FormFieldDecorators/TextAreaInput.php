<?php
/**
 * HTML textarea input decorator for FormField.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models\FormFieldDecorators;

/**
 * HTML textarea input decorator for FormField. Note decorators include a
 * reference to the field they are decorating.
 */
class TextAreaInput extends FormFieldDecorator
{
	/**
	 * Returns HTML for textarea input.
	 * 
	 * @param string $value Field value
	 * @return string
	 */
	public function getHtml($value)
	{
		$html =		'<label for="form_field_id_'
						.		$this->form_field->id . '">'
						.		(($this->form_field->required) ? '<span class="required">* </span>' : '')
						.		$this->form_field->label
						. '</label>' . PHP_EOL
						. '<textarea'
						.		' id="form_field_id_' . $this->form_field->id . '"'
						.		' name="form_field_id_' . $this->form_field->id . '">'
						.		$value
						.	'</textarea>';
		return $html;
	}
}

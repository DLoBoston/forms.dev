<?php
/**
 * HTML text input decorator for FormField.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models\FormFieldDecorators;

/**
 * HTML text input decorator for FormField. Note decorators include a
 * reference to the field they are decorating.
 */
class TextInput extends FormFieldDecorator
{	
	/**
	 * Returns HTML for text input.
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
						. '<input'
						.		' id="form_field_id_' . $this->form_field->id . '"'
						.		' type="text"'
						.		' value="' . $value . '"'
						.		' name="form_field_id_' . $this->form_field->id . '">';
		return $html;
	}
}

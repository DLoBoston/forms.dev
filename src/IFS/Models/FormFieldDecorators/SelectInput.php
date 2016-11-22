<?php
/**
 * HTML select input decorator for FormField.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models\FormFieldDecorators;

/**
 * HTML select input decorator for FormField. Note decorators include a
 * reference to the field they are decorating.
 */
class SelectInput extends FormFieldDecorator
{
	/**
	 * Returns HTML for select input.
	 * 
	 * @param string $value Field value
	 * @return string
	 */
	public function getHtml($value)
	{
		// If value is defined but not array, convert to array so that it can be
		// used below for select fields that are single and select-multiple.
		if ($value && !is_array($value)) :
			$value = array($value);
		endif;
		
		// Construct HTML
		$html =		'<label for="form_field_id_'
						.		$this->form_field->id . '">'
						.		(($this->form_field->required) ? '<span class="required">* </span>' : '')
						.		$this->form_field->label
						. '</label>' . PHP_EOL
						. '<select'
						.		' id="form_field_id_' . $this->form_field->id . '"'
						.		(($this->form_field->type == 'select-multiple') ? ' multiple' : '')
						.		' name="form_field_id_' . $this->form_field->id
						.		(($this->form_field->type == 'select-multiple') ? '[]' : '') . '">' . PHP_EOL
						.		'<option value="">Please select</option>' . PHP_EOL;
		foreach ($this->form_field->form_field_options as $option) :
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

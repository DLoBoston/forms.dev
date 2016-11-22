<?php
/**
 * HTML hidden input decorator for FormField.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models\FormFieldDecorators;

/**
 * HTML hidden input decorator for FormField. Note decorators include a
 * reference to the field they are decorating.
 */
class HiddenInput extends FormFieldDecorator
{	
	/**
	 * Returns HTML for hidden input.
	 * 
	 * @param string $value Field value
	 * @return string
	 */
	public function getHtml($value)
	{
		$html =		'<input'
						.		' id="form_field_id_' . $this->form_field->id . '"'
						.		' type="hidden"'
						.		' value="' . $value . '"'
						.		' name="form_field_id_' . $this->form_field->id . '">';
		return $html;
	}
}

<?php
/**
 * HTML matrix checkbox input decorator for FormField.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models\FormFieldDecorators;

/**
 * HTML matrix checkbox input decorator for FormField. Note decorators include a
 * reference to the field they are decorating.
 */
class MatrixCheckboxInput extends FormFieldDecorator
{
	/**
	 * Returns HTML for matrix checkbox input.
	 * 
	 * @param string $value Field value
	 * @return string
	 */
	public function getHtml($value)
	{
		// Separate field options into column and row options
		$column_options = $this->form_field->form_field_options->filter(function ($option) {
			return ($option->type === "matrix-column");
		});
		$row_options = $this->form_field->form_field_options->filter(function ($option) {
			return ($option->type === "matrix-row");
		});
		
		// Build matrix header
		$matrix_header_columns = null;
		foreach ($column_options as $column_option) :
			$matrix_header_columns .= "<th>{$column_option->value}</th>" . PHP_EOL;
		endforeach;
		
		// Build matrix rows
		$matrix_rows = null;
		foreach ($row_options as $row_option) :
			
			$matrix_rows .=	'<tr>'
										.		"<th>{$row_option->value}</th>";
										
			foreach ($column_options as $column_option) :
				$matrix_rows .=	'<td>'
											.		'<input'
											.			' type="checkbox"'
											.			' name="form_field_id_' . $row_option->form_field_id . '_option_id_' . $row_option->id . '[]"'
											.			' value="' . $column_option->value . '"'
											.			(($value && array_key_exists($row_option->value, $value) && array_search($column_option->value, $value[$row_option->value]) !== false) ? ' checked' : '')														
											.		'>'
											. '</td>';
			endforeach;
			
			$matrix_rows .=	'</tr>';
			
		endforeach;
		
		// Construct HTML
		$html =		'<p>'
						.		(($this->form_field->required) ? '<span class="required">* </span>' : '')
						.		$this->form_field->label
						. '</p>'
						. '<table class="table">'
						.		'<tr>'
						.			'<th></th>'
						.			$matrix_header_columns
						.		'</tr>'
						.		$matrix_rows
						.	'</table>';
		
		return $html;
	}
}

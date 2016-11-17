<?php
/**
 * HTML matrix radio input decorator for Form Element.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models\FormElementDecorators;

/**
 * HTML matrix radio input decorator for Form Element. Note decorators include a
 * reference to the element they are decorating.
 */
class MatrixRadioElement extends FormElementDecorator
{
	/**
	 * Returns HTML for matrix radio input.
	 * 
	 * @param string $value Element value
	 * @return string
	 */
	public function getHtml($value)
	{
		// Separate element options into column and row options
		$column_options = $this->form_element->form_element_options->filter(function ($option) {
			return ($option->type === "column-header");
		});
		$row_options = $this->form_element->form_element_options->filter(function ($option) {
			return ($option->type === "row-header");
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
											.			' type="radio"'
											.			' name="form_element_id_' . $row_option->form_element_id . '_option_id_' . $row_option->id . '"'
											.			' value="' . $column_option->value . '"'
											.		'>'
											. '</td>';
			endforeach;
			
			$matrix_rows .=	'</tr>';
			
		endforeach;
		
		// Construct HTML
		$html =		'<p>'
						.		(($this->form_element->required) ? '<span class="required">* </span>' : '')
						.		$this->form_element->label
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

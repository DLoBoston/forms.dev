<?php
/**
 * HTML hidden input decorator for Form Element.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models;

/**
 * HTML hidden input decorator for Form Element
 */
class HiddenElement extends FormElementDecorator
{	
	/**
	 * Returns HTML for hidden input.
	 * 
	 * @param string $value Optional element value
	 * @return string
	 */
	public function getHtml($value = null)
	{
		$html =		'<input'
						.		' id="form_element_id_' . $this->form_element->form_element_id . '"'
						.		' type="hidden"'
						.		' value="' . $value . '"'
						.		' name="form_element_id_' . $this->form_element->form_element_id . '">';
		return $html;
	}
}

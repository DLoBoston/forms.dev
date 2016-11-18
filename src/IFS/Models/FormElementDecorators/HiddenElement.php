<?php
/**
 * HTML hidden input decorator for Form Element.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models\FormElementDecorators;

/**
 * HTML hidden input decorator for Form Element. Note decorators include a
 * reference to the element they are decorating.
 */
class HiddenElement extends FormElementDecorator
{	
	/**
	 * Returns HTML for hidden input.
	 * 
	 * @param string $value PHP serialized element value.
	 * @return string
	 */
	public function getHtml($value)
	{
		// Unserialize value
		$value = unserialize($value);
		
		// Construct HTML
		$html =		'<input'
						.		' id="form_element_id_' . $this->form_element->form_element_id . '"'
						.		' type="hidden"'
						.		' value="' . $value . '"'
						.		' name="form_element_id_' . $this->form_element->form_element_id . '">';
		return $html;
	}
}

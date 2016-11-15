<?php
/**
 * Form Element Decorator.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models\FormElementDecorators;

/**
 * Abstract class for decorating FormElements with other functionality, for example
 * the ability to be rendered as HTML.
 */
abstract class FormElementDecorator extends \IFS\Models\FormElement
{
  /** @var IFS\Models\FormElement Element being decorated. */
  protected $form_element;
	
	public function __construct(\IFS\Models\FormElement $generic_form_element) {
		$this->form_element = $generic_form_element;
	}
}

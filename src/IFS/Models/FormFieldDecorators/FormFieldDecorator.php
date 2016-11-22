<?php
/**
 * Form Field Decorator.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models\FormFieldDecorators;

/**
 * Abstract class for decorating FormField with other functionality, for example
 * the ability to be rendered as HTML.
 */
abstract class FormFieldDecorator extends \IFS\Models\FormField
{
  /** @var IFS\Models\FormField Field being decorated. */
  protected $form_field;
	
	public function __construct(\IFS\Models\FormField $generic_form_field) {
		$this->form_field = $generic_form_field;
	}
}

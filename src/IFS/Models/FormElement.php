<?php
/**
 * Model of form fields.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Models interaction with form_elements entity in persistent data.
 * Form elements are fields on a form.
 */
class FormElement extends Model
{
  /** @var string Overrides ID assumed by Eloquent */
  protected $primaryKey = 'form_element_id';
  
}

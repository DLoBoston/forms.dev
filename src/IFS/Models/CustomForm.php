<?php
/**
 * Custom form model.
 * @author Digital D.Lo <WebDevDLo@gmaiil.com>
 */
namespace IFS\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Models interaction with custom_form entity in persistent data.
 * Forms are a set of fields to collect input for a specific purpose.
 */
class CustomForm extends Model
{
	/** @var string Overrides ID assumed by Eloquent */
	protected $primaryKey = 'form_id';
}

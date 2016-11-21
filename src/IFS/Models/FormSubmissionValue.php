<?php
/**
 * Form submission value model.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Models interaction with form_submission_values entity in persistent data.
 * Form Submission Values are the actual inputs submitted by end-users on a form.
 */
class FormSubmissionValue extends Model
{
	/** @var array Eloquent convention that allows mass assignment of certain properties. */
	protected $fillable = ['form_element_id', 'value'];
	
	/**
	 * Eloquent convention - All of the relationships to be touched.
	 *
	 * @var array
	 */
	protected $touches = ['form_submission'];
	
	/**
	 * Eloquent convention - Get the form submission that this form submission value belongs to.
	 */
	public function form_submission()
	{
			return $this->belongsTo('IFS\Models\FormSubmission');
	}
	
}

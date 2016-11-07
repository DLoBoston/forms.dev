<?php
/**
 * Form submission model.
 * @author dennis <dennis@ifscore.com>
 */
namespace IFS\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Models interaction with form_submissions entity in persistent data.
 * Form Submissions are a record of what custom forms have been submitted by end-users.
 */
class FormSubmission extends Model
{
	/** @var string Overrides ID assumed by Eloquent */
	protected $primaryKey = 'submission_id';
	
	/**
	 * Eloquent function to get the submission values for a specific form.
	 */
	public function form_submission_values()
	{
			return $this->hasMany('IFS\Models\FormSubmissionValue', 'submission_id');
	}
}

$(document).ready(function() {
    
	//// ONLOAD EVENTS ------------------------------------

	// Setup handler - Check for required fields before form submission.
	$("form[id^='frm_id_']").submit(function(event) {
		
		var blnValidSubmission = true;
		
		$("[data-required]").each(function() {
			
			switch($(this).prop('type')) {
				
				// Check standard inputs
				case 'text':
				case 'textarea':
				case 'select-one':
				case 'select-multiple':
				default:
					if ($.trim($(this).val()) === "") {
						blnValidSubmission = false;
					}
					break;
				
				// Radio and checkbox
				case 'radio':
				case 'checkbox':
					if (!$("input[name='" + $(this).prop('name') + "']:checked").val()) {
						blnValidSubmission = false;
					}
					break;
			}
		});
		
		if (!blnValidSubmission) {
			event.preventDefault();
		}
		
	});

});
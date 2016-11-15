$(document).ready(function() {
    
	//// ONLOAD EVENTS ------------------------------------

	// Setup handler - Check for required fields before form submission.
	$("form[id^='frm_id_']").submit(function(event) {
		
		var blnValidSubmission = true;
		
		$("[data-required]").each(function() {
			
			console.log($(this));
			
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
				
				// Selects, checkboxes, and radios
//				case 'radio':
//					$("[name=" + $(this).prop('name') + "")
//						if ($.trim($(this).val()) === "") {
//							blnValidSubmission = false;
//						}
//					break;
			}
		});
		
		if (!blnValidSubmission) {
			event.preventDefault();
		}
		
	});

});
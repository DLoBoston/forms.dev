$(document).ready(function() {
  
	//// GLOBAL ------------------------------------

	var validation_errors = [];
	
	//// CUSTOM OBJECTS ------------------------------------

	// Validation Error
	var ValidationError = function (element_name, error) {
		this.element_name = element_name;
		this.error = error;
	};
    
	//// ONLOAD EVENTS ------------------------------------

	// Setup handler - Check for required fields before form submission.
	$("form[id^='frm_id_']").submit(function(event) {
		
		// Initialize submission boolean
		var blnValidSubmission = true;
		var general_error_msg = "This field is required";
		
		// Check for all generally required fields
		$("[data-required='1']").each(function() {
			
			switch($(this).prop('type')) {
				
				// Check standard inputs
				case 'text':
				case 'textarea':
				case 'select-one':
				case 'select-multiple':
				default:
					if ($.trim($(this).val()) === "") {
						blnValidSubmission = false;
						recordError($(this).prop('name'), general_error_msg);
					}
					break;
				
				// Radio and checkbox
				case 'radio':
				case 'checkbox':
					if (!$("input[name='" + $(this).prop('name') + "']:checked").val()) {
						blnValidSubmission = false;
						recordError($(this).prop('name'), general_error_msg);
					}
					break;
			}
		});
		
		if (!blnValidSubmission) {
			event.preventDefault();
			displayErrors();
		}
		
	});

	//// FUNCTIONS ------------------------------------
	
	function recordError(name, error) {
		validation_errors.push(new ValidationError(name, error));
	}
	
	function displayErrors() {
		
		// Initialize vars
		var errors_list_items = '';
		
		// Convert errors to html list elements
		for (var i = 0; i < validation_errors.length; i++) {
			errors_list_items += '<li>' + validation_errors[i].element_name + ': ' + validation_errors[i].error + '</li>';
		}
		
		// Plug errors list into html container for display
		html =	'<ul id="error_messages">'
					+		errors_list_items
					+	'</ul>';
		
		// Display errors (removing any previous display)
		$("ul#error_messages").remove();
		$("form[id^='frm_id_']").before(html);
		
		// Clear stored error messages
		validation_errors = [];
	}

});
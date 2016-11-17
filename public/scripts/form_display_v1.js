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
		
		// Initialize vars
		var blnValidSubmission = true;
		
		// Find all field containters with required fields
		$("[data-required='1']").each(function() {
			
			// Check the input for value by type, and record error if applicable
			$(this).find(":input").each(function() {
				switch($(this).prop('type')) {
					case 'text':
					case 'textarea':
					case 'select-one':
					case 'select-multiple':
					default:
						if ($.trim($(this).val()) === "") {
							blnValidSubmission = false;
							recordError($(this).prop('name'), "This field is required");
						}
						break;
					case 'radio':
					case 'checkbox':
						if (!$("input[name='" + $(this).prop('name') + "']:checked").val()) {
							blnValidSubmission = false;
							recordError($(this).prop('name'), "This field is required");
							return false; // This prevents the same validation check from being applied to each option
						}
						break;
				}
			});
		});
		
		// Prevent submission and display errors if any validation issues found
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
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
		required_fields = [];
		
		// Find all required fields, and add to array
		$("[data-required='1']").each(function() {
			// If name not already found, add it
			if (!required_fields.includes($(this).prop('name'))) {
				required_fields.push($(this).prop('name'));
			}
		});
		
		console.log(required_fields);
		
		// Loop over all required fields
		for (var i = 0; i < required_fields.length; i++) {
			
			// Find field in DOM
			$("[name=" + required_fields[i] + "]").each(function() {
				
				// Check for the field's value based on it's type, and if applicable record any errors
				switch($(this).prop('type')) {

					// For standard inputs...
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

					// For radio and checkboxes...
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
			
		}
		
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
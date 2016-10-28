$(document).ready(function() {
	
	// Setup form element constructor
	function FormElement(id, type, label) {
		this.id = id;
		this.type = type;
		this.label = label;
	}
	
	// Store initial form elements
	var form_elements = [];
	$("div[data-form-element-id]").each(function() {
		form_elements.push(new FormElement($(this).data("form-element-id"),
																				$(this).data("form-element-label"),
																				$(this).data("form-element-label")));
	});
	
	// Setup form delete button
	$("#btnDelete").click(function() {
		$("#frmBuilder").prepend('<input type="hidden" name="_METHOD" value="DELETE"/>').submit();
	});
	
	// Setup links to delete form elements
	$("a[data-form-element-action='delete']").click(function(event) {
		// Prevent default link action
		event.preventDefault();
		// Remove element from javascript storage
		for (var i = 0; i < form_elements.length; i++) {
			if (form_elements[i].id == $(this).parent().data("form-element-id")) {
				form_elements.splice(i,1);
			}
		}
		// Remove element from DOM
		$(this).parent().remove();
	});
	
	// On builder submission, serialize form_elements and store in hidden field
	$("#frmBuilder").submit(function(event) {
		$("input[name='form_elements']").val(JSON.stringify(form_elements));
	});
	
});
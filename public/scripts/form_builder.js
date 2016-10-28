$(document).ready(function() {
	
	// Setup form delete
	$("#btnDelete").click(function() {
		$("#frmBuilder").prepend('<input type="hidden" name="_METHOD" value="DELETE"/>').submit();
	});
	
	// Setup links to delete form elements
	$("a[data-element-action='delete']").click(function(event) {
		// Prevent default link action
		event.preventDefault();
		// Remove element from DOM
		$(this).parent().remove();
	});
	
});
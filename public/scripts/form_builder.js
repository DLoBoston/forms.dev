$(document).ready(function() {
	
	$("#btnDelete").click(function() {
		$("#frmBuilder").prepend('<input type="hidden" name="_METHOD" value="DELETE"/>').submit();
	});
	
});
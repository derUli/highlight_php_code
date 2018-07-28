$(function() {
	// Setup CodeMirror Editor for "Code" TextArea
	if (document.getElementById("code")) {
		var phpCodeMirror = CodeMirror.fromTextArea(document
				.getElementById("code"),

		{
			lineNumbers : true,
			matchBrackets : true,
			mode : "application/x-httpd-php",
			indentUnit : 0,
			indentWithTabs : false,
			enterMode : "keep",
			tabMode : "shift",
			lineWrapping : true
		});
	}
	// Delete Code Action - Confirmation
	$(".delete-form-container form").submit(function() {
		return confirm(Translation.AskForDelete);
	});
});
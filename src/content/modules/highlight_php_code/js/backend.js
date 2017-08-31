$(function() {
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
	$(".delete-form-container form").submit(function() {
		return confirm(Translation.ASK_FOR_DELETE);
	});
});
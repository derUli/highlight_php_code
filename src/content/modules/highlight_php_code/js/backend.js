$(function() {
	var phpCodeMirror = CodeMirror.fromTextArea(
			document.getElementById("code"),

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
});
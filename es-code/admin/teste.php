<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
	height: 300,
	selector: "textarea",
	content_css: "content.css",
	relative_urls: false,
	
	toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | forecolor backcolor emoticons", 
	
	file_browser_callback: explorer,
	
	plugins: [
		"autolink link image lists",
		"searchreplace insertdatetime media",
		"save table emoticons paste textcolor",
		"advlist contextmenu code",
		
	]

 });
function explorer(field_name, url, type, win) {
	tinyMCE.activeEditor.windowManager.open({
		url				: "explorer/explorer.php",
		width			: 700,
		height			: 500,
		inline			: "yes",
		close_previous	: "no",
		title			: "File Explorer"
	},{
		window			: win,
		input			: field_name
	});
}
</script>
</head>

<body>
<textarea id="area" name="area"></textarea>
</body>
</html>
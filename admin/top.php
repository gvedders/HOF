<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hall of Fame Control Panel</title>
<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript"> 
tinyMCE.init({
	// General options
	mode : "textareas",
	theme : "advanced",
	plugins : "spellchecker,inlinepopups",
 
	// Theme options
	
	theme_advanced_buttons1 : "bold,italic,underline,|,spellchecker,removeformat,code",
	theme_advanced_buttons2 : "",
	theme_advanced_buttons3 : "",
	theme_advanced_buttons4 : "",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : true,
	 
	// Example content CSS (should be your site CSS)
	content_css : "/js/tinymce/examples/css/content.css"
 
});
</script>
<style type="text/css">
* {
	padding: 0;
	margin: 0;
}
#wrapper {
	padding: 20px;
	border: 1px solid #CCC;
	margin: 15px;
	width: 550px;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
#wrapper h1 {
	padding-bottom: 8px;
	color: #333;
}
.smText {
	font-size: 10px;
	color: #666;
}
table {
	margin-top: 8px;
}
#playerList {
	list-style: none;
}
#playerList li {
	padding: 4px 0px 6px 0px;
}
#playerList li a:link, a:visited {
	color: #06F;
	text-decoration: none;
}
#playerList li a:hover, a:active {
	color: #09F;
	text-decoration: underline;
}
#editor td {
	padding-bottom: 8px;
}
#editor input[type=text] {
	border: 1px solid #CCC;
	width: 400px;
}
#editor textarea {
	border: 1px solid #CCC;
	width: 400px;
	height: 100px;
}
#editor select {
	border: 1px solid #CCC;
	width: 200px;
}
#editor select, #editor textarea, #editor input[type=text] {
	margin-left: 5px;
	padding: 3px;
}
#editor input[type=submit], input[type=file] {
	font-weight: bold;
	padding: 5px;
	background-color: #DFDFDF;
	text-shadow: 0px 1px #FFF;
	border-bottom: 1px solid #999;
	border-right: 1px solid #999;
	border-left: 1px solid #CCC;
	border-top: 1px solid #CCC;
	color: #333;
}
.btn {
	float: right;
	line-height: 2.1em;
	font-weight: bold;
	margin-left: 8px;
	width: 120px;
	height: 25px;
	text-align: center;
	background-color: #DFDFDF;
	text-shadow: 0px 1px #FFF;
	border-bottom: 1px solid #999;
	border-right: 1px solid #999;
	border-left: 1px solid #CCC;
	border-top: 1px solid #CCC;
}
.btn a:link, a:visited {
	width: 100%;
	height: 100%;
	overflow: hidden;
	color: #333;
	text-decoration: none;
}
.btn a:hover, a:active {
	width: 100%;
	height: 100%;
	overflow: hidden;
	color: #000000;
	text-decoration: none;
}
.btn2 {
	line-height: 1.6em;
	font-weight: bold;
	width: 120px;
	height: 25px;
	text-align: center;
	background-color: #DFDFDF;
	text-shadow: 0px 1px #FFF;
	border-bottom: 1px solid #999;
	border-right: 1px solid #999;
	border-left: 1px solid #CCC;
	border-top: 1px solid #CCC;
}
.btn2 a:link, a:visited {
	width: 100%;
	height: 100%;
	overflow: hidden;
	color: #333;
	text-decoration: none;
}
.btn2 a:hover, a:active {
	width: 100%;
	height: 100%;
	overflow: hidden;
	color: #000000;
	text-decoration: none;
}
#footer {
	padding-top: 20px;
	height: 25px;
	width: 100%;
}
.updImg {
	border: 1px solid #ccc;
	padding: 5px;
	margin-bottom: 15px;
}
.rtnHome a:link, a:visited {
	margin-left: 8px;
	color: #06f;
	text-decoration: none;
}
.rtnHome a:hover, a:active {
	margin-left: 8px;
	color: #09f;
	text-decoration: underline;
}
</style>
</head>
<body>
<div id="wrapper">

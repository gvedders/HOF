<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hall of Fame Control Panel</title>
<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>

<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<style type="text/css">
* {
	padding: 0;
	margin: 0;
}
.text {background-color: red;} 
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
.alphabet {	
	width: 18px;
	height: 20px;
	background-color: #dfdfdf;
	text-shadow: 0px 1px #fff;
	font-size: 12px;
	font-weight: bold;
	padding-bottom: 2px; 
	border-top: 1px solid #ccc;
	border-bottom: 1px solid #999;
	border-left: 1px solid #ccc;
	border-right: 1px solid #999;
	font-family: Arial, Helvetica, sans-serif;
 }
.alphabet:hover {background-color: #efefef; cursor: pointer;}
.previewLink:link, .previewLink:visited {
	display: block;
	width: 55px;
	height: 15px;
	float: right;
	outline: none;
	border: 0; 
}
.previewLink img {border: 0; outline: none;}
#playerList {
	margin-top: 15px;
	margin-bottom: 10px;
	list-style: none;
}
#playerList li {
	padding: 4px 0px 6px 0px;
	display: block;
	clear: both;
}
#playerList li a:link,
#playerList li a:visited {
	color: #06F;
	text-decoration: none;
}
#playerList li a:hover,
#playerList li a:active {
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
#editor input[type=submit]:hover, input[type=file]:hover {background-color: #efefef;}
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
.btn:hover {background-color: #efefef;}
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
.btn2:hover {background-color: #efefef;} 
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
.listItem {
	border-bottom: 1px solid #e6e6e6; 
	display: block;
	height: 15px; 
	overflow: hidden;
}
.listItem:hover {
	background-image:url('preview.jpg'); 
	background-color: #f0f0f0;
	background-repeat: no-repeat;
	background-position: right center;
}
/*
.rtnHome a:link, a:visited {
	margin-left: 8px;
	color: #06f;
	text-decoration: none;
}
.rtnHome a:hover, a:active {
	margin-left: 8px;
	color: #09f;
	text-decoration: underline;
} */
</style>
<link rel="stylesheet" href="fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="ie.css" />
<![endif]-->
<script type="text/javascript">
	$(document).ready(function() {
		$(".previewLink").fancybox({
			'width'				: 980,
			'height'			: 520,
			'autoScale'			: false,
			'transitionIn'		: 'none',
			'transitionOut'		: 'none',
			'type'				: 'iframe'
		});
	});
</script>
</head>
<body>
<div id="wrapper">

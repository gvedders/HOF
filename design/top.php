<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AQ Hall of Fame <?php echo date('Y-m-d H:i:s'); ?></title>
<?php 
if ($op == "") {
?>
<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
<script type="text/javascript" src="js/jquery.cross-slide.min.js"></script>
<script type="text/javascript"> 
//<!--
jQuery(function($) {
    $('#container').crossSlide({
      fade: .0000000001
    }, [
      {
        src:  '/images/bg.jpg',
        from: 'center left',
        to:   'center right',
        time: 60
      }, {
        src:  '/images/bg.jpg',
        from: 'center right',
        to:   'center left',
        time: 60
      }
    ]);
});
// --> 
</script>
<script>
  $(".testlink").fadeOut("slow");
</script>
<?php } ?>

<style type="text/css">
* {
	margin:0;
	padding:0;
	color:#232322;
	outline: none;
}
img {
	outline: none;
	border: none;
}
body {
	width: 1360px;
	height: 768px;
	overflow: hidden;
	background: url(images/bg_static_light_blur.jpg) no-repeat;
}
 @font-face {
	font-family: Trajan;
	src: url('fonts/trajan.otf');
}
 @font-face {
	font-family: Berling;
	src: url('fonts/berlingroman.ttf');
}
#container {
	width: 1360px;
	height: 768px;
	overflow: hidden;
	margin:0;
	padding:0;
	z-index: -1;
	text-align: center;
}
/* ------------------------------------- NAVIGATION = TEAM BROWSER ------------------------------------- */
#navigation {
	position: absolute;
	width: 800px;
	height: auto;
	left: 50%;
	margin-left: -400px;
	top: 73px;
	z-index: 1;
	font-family: "Berling", Berling, "Berling Roman", Georgia, "Times New Roman", Times, serif;
}
#navigation table {
	width: 100%;
	padding: 0;
	margin: 0;
	margin-left: 2px;
}
#navigation li {
	display: block;
	height: 45px;
	min-height: 45px;
	max-height: 45px;
	overflow: hidden;
	border: 1px solid #ababab;
	list-style-type: none;
	background: url(images/selection_bg.jpg) #e6e6e6 repeat-x top left;
	margin-bottom: -1px;
	text-align: center;
	font-size: 19px;
	line-height: 2.3em;
	text-shadow: 0px 1px #FFF;
	margin-left: -3px;
}
#navigation li a {
	display: block;
	width: 100%;
	height: 100%;
	text-decoration: none;
}
#navigation li a:active {
	background: url(images/selection_active.png) #dedede repeat-x top left;
	color: #000;
}
#navigation table td {
	width: 50%;
}
/* ------------------------------------- MAINMENU = MAIN MENU ------------------------------------- */
#mainmenu {
	position: absolute;
	width: 536px;
	height: 585px;
	left: 50%;
	margin-left: -268px;
	top: 40px;
	z-index: 1;
	text-align: center;
}
#mainmenu table {
	width: 453px;
	padding: 0;
	margin-left: 35px;
	margin-top: -2px;
}
#mainmenu li {
	display: block;
	height: 85px;
	min-height: 85px;
	max-height: 85px;
	overflow: hidden;
	border: 1px solid #ababab;
	list-style-type: none;
	background: url(images/selection_bg.jpg) #e6e6e6 repeat-x top left;
	margin-bottom: -1px;
	text-align: center;
	font-size: 26px;
	line-height: 3.3em;
	text-shadow: 0px 1px #FFF;
	font-family: "Berling", Berling, "Berling Roman", Georgia, "Times New Roman", Times, serif;
}
#mainmenu li a {
	display: block;
	width: 100%;
	height: 100%;
	text-decoration: none;
}
#mainmenu li a:active {
	background: url(images/selection_active_main.png) #dedede repeat-x top left;
	color: #000;
}
#mainmenu table td {
	width: 50%;
}

/* ------------------------------------- NAVIGATION #2 = PLAYER BROWSER ------------------------------------- */
#navigation2 {
	position: absolute;
	width: 400px;
	height: auto;
	left: 50%;
	margin-left: -200px;
	top: 73px;
	z-index: 1;
	font-family: "Berling", Berling, "Berling Roman", Georgia, "Times New Roman", Times, serif;
}
#navigation2 table {
	width: 100%;
	padding: 0;
	margin: 0;
	margin-left: 2px;
}
#navigation2 li {

	width: 400px;
	display: block;
	height: 45px;
	min-height: 45px;
	max-height: 45px;
	overflow: hidden;
	border: 1px solid #ababab;
	list-style-type: none;
	background: url(images/selection_bg.jpg) #e6e6e6 repeat-x top left;
	margin-bottom: -1px;
	text-align: center;
	font-size: 19px;
	line-height: 2.3em;
	text-shadow: 0px 1px #FFF;
}
#navigation2 li a {
	display: block;
	width: 100%;
	height: 100%;
	text-decoration: none;
}
#navigation2 li a:active {
	background: url(images/selection_active.png) #dedede repeat-x top left;
	color: #000;
}
#navigation2 table td {
	padding-left: 5px;
	padding-right: 5px;
}
#selectionHeader {
	margin-bottom: 5px;
}
#selectionFooter {
	height: 60px;
	width: 400px;
	overflow: hidden;
	font-size: 24px;
	text-shadow: 0px 1px #FFF;
	border: 1px solid #ababab;
	background: url(images/selection_bg.jpg) #e6e6e6 repeat-x top left;
}
#returnHome {
	width: 309px;
	position: absolute;
	left: 50%;
	padding: 0;
	margin-left: -154px;
	top: 690px;
}
.navStyle {
	color: #666666;
	display: block;
	padding-bottom: 8px;
}
.navItalics {
	color: #666666;
	font-style: italic;
	font-size: 80%;
	line-height: 1em;
	font-family: Georgia, "Times New Roman", Times, serif;
}
#profile {
	width: 798px;
	height: auto;
	min-height: 340px;
	max-height: 530px;
	overflow: hidden;
	background: url(images/profilebg.jpg) #e6e6e6 repeat-x top right;
	position: absolute;
	left: 50%;
	margin-left: -400px;
	top: 102px;
	padding: 10px 15px 20px 15px;
	z-index: 1;
	border: 1px solid #ababab;
	font-size: 18px;
}
#profTitle {
	padding-top: 7px !important;
	font-family: Trajan, "Trajan", "Times New Roman", Times, serif;
	font-size: 32px;
	text-shadow: 0px 1px #FFF;
}
#profHeader {
	width: 800px;
	height: 60px;
	position: absolute;
	left: 50%;
	margin-left: -400px;
	top: 38px;
	z-index: 1;
}
#photoCont {
	float: left;
	height: 100%;
}
#photo {
	background-color: #F5F5F5;
	border: 1px solid #ababab;
	padding: 5px;
	margin-right: 15px;
	margin-top: 5px;
	width: auto;
	float: left;
}
#profInfo {
	float: right;
	text-align: left;
	width: 590px;
	margin-top: -8px;
}
.subtitle {
	font-weight: bold;
	color: #333;
	text-shadow: 0px 1px #FFF;
	width: 160px;
}
.subentry {text-align: left;}
#profile td {
	padding-top: 3px;
}
#atAQ {
	margin-top: 15px;
}
.smallText {
	font-size: 16px;
	text-align:justify;
	padding-right: 50px;
}
#honors {
	float: left;
	height: 30px;
	padding-top: 8px;
	padding-right: 4px;
}
.padFix {font-size: 19px; padding-top: 14px;}
.padFix2 {display: block; padding-top: 14px;}
.underConst {font-size: 16px; text-align: left; display: block;}
</style>
<!--[if IE]>
        <link rel="stylesheet" type="text/css" href="ie.css" />
<![endif]-->
</head>
<body>
<div id="container"></div>

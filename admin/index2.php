<?php

// Read in submitted values via GET or POST depending page

$a = $_GET['a'];
$id = $_GET['id'];
$val_input = $_POST['val_input'];
$idpict = $_POST['idpict'];
$imgfile = $_FILES['imgfile']['tmp_name'];
$imgfile_name = $_FILES['imgfile']['name'];
$imgfile_size = $_FILES['imgfile']['size'];
$imgfile_type = $_FILES['imgfile']['type'];
$currentpage = $_GET['currentpage'];

// Test if OP is given to up via POST or GET and set value accordingly
if ($a == "")
{
	$op = $_POST['op'];
} else {
	$op = $a;
}

$user = 'admin';
$pass = 'aqHOF10';

function httpauth(){
   header('WWW-Authenticate: Basic realm="Aquinas College Hall of Fame"');
   header('HTTP/1.0 401 Unauthorized');
   echo 'Access denied';
   exit;
}

while($_SERVER['PHP_AUTH_USER'] != $user && $_SERVER['PHP_AUTH_PW'] != $pass){
httpauth();
}

include("top.inc");

// Switch statement for carrying out request(s)

switch ($op) {
	case "page" :
		page($currentpage);
		break;

	case "edit" :
		edit($id);
		break;

	case "process" :
		process($val_input);
		break;

	case "photo" :
		photo($idpict,$imgfile,$imgfile_name,$imgfile_size,$imgfile_type);

	case "az" :
		az($val_input);
		break;

	default :
		page($currentpage);
		break;
}

function alpha() {
?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	  <input type="hidden" name="op" value="az">
	  <input type="submit" name="val_input[0][A]" value="A">
	  <input type="submit" name="val_input[0][B]" value="B">
	  <input type="submit" name="val_input[0][C]" value="C">
	  <input type="submit" name="val_input[0][D]" value="D">
	  <input type="submit" name="val_input[0][E]" value="E">
	  <input type="submit" name="val_input[0][F]" value="F">
	  <input type="submit" name="val_input[0][G]" value="G">
	  <input type="submit" name="val_input[0][H]" value="H">
	  <input type="submit" name="val_input[0][I]" value="I">
	  <input type="submit" name="val_input[0][J]" value="J">
	  <input type="submit" name="val_input[0][K]" value="K">
	  <input type="submit" name="val_input[0][L]" value="L">
	  <input type="submit" name="val_input[0][M]" value="M">
	  <input type="submit" name="val_input[0][N]" value="N">
	  <input type="submit" name="val_input[0][O]" value="O">
	  <input type="submit" name="val_input[0][P]" value="P">
	  <input type="submit" name="val_input[0][Q]" value="Q">
	  <input type="submit" name="val_input[0][R]" value="R">
	  <input type="submit" name="val_input[0][S]" value="S">
	  <input type="submit" name="val_input[0][T]" value="T">
	  <input type="submit" name="val_input[0][U]" value="U">
	  <input type="submit" name="val_input[0][V]" value="V">
	  <input type="submit" name="val_input[0][W]" value="W">
	  <input type="submit" name="val_input[0][X]" value="X">
	  <input type="submit" name="val_input[0][Y]" value="Y">
	  <input type="submit" name="val_input[0][Z]" value="Z">
	</form>
<?php
}

function az($val_input) {
?>
	<div id="topper">
	<div class="btn"><a href="<?php echo "".$_SERVER[PHP_SELF].""; ?>?a=edit">+ Add New Athlete</a></div>
  </div>
<h1>EDIT Athlete</h1>
<?php alpha(); ?>
<ul id="playerList">
<?php
	include("../config/settings.php");
	foreach ($val_input[0] as $value) {
		$keyval = key($val_input[0]);
		$proc_input[0][$keyval] = secure($value);
		next($val_input[0]);
	}
	if ($proc_input[0][A] != "") { $let = "A"; }
	if ($proc_input[0][B] != "") { $let = "B"; }
	if ($proc_input[0][C] != "") { $let = "C"; }
	if ($proc_input[0][D] != "") { $let = "D"; }
	if ($proc_input[0][E] != "") { $let = "E"; }
	if ($proc_input[0][F] != "") { $let = "F"; }
	if ($proc_input[0][G] != "") { $let = "G"; }
	if ($proc_input[0][H] != "") { $let = "H"; }
	if ($proc_input[0][I] != "") { $let = "I"; }
	if ($proc_input[0][J] != "") { $let = "J"; }
	if ($proc_input[0][K] != "") { $let = "K"; }
	if ($proc_input[0][L] != "") { $let = "L"; }
	if ($proc_input[0][M] != "") { $let = "M"; }
	if ($proc_input[0][N] != "") { $let = "N"; }
	if ($proc_input[0][O] != "") { $let = "O"; }
	if ($proc_input[0][P] != "") { $let = "P"; }
	if ($proc_input[0][Q] != "") { $let = "Q"; }
	if ($proc_input[0][R] != "") { $let = "R"; }
	if ($proc_input[0][S] != "") { $let = "S"; }
	if ($proc_input[0][T] != "") { $let = "T"; }
	if ($proc_input[0][U] != "") { $let = "U"; }
	if ($proc_input[0][V] != "") { $let = "V"; }
	if ($proc_input[0][W] != "") { $let = "W"; }
	if ($proc_input[0][X] != "") { $let = "X"; }
	if ($proc_input[0][Y] != "") { $let = "Y"; }
	if ($proc_input[0][Z] != "") { $let = "Z"; }
$sql = "SELECT * FROM profile WHERE lastname LIKE '$let%' ORDER BY lastname ASC";
$result = $conn->query($sql);
 // while there are rows to be fetched...
        while ($list = $result->fetch_assoc()) {
                // echo data
                $team = $list['team'];
                echo "<li><a href=\"".$_SERVER[PHP_SELF]."?a=edit&id=".$list['id']."\">".$list['firstname']." ".$list['lastname']." - (";
                $sql2 = "SELECT * FROM sports WHERE id = '$team'";
                $result2 = $conn->query($sql2) or trigger_error("SQL", E_USER_ERROR);
                while ($list2 = $result2->fetch_assoc()) {
                        echo "".$list2['sport']." ";
                }
                if ($list['aa'] == "1") {
                        echo "All-American ";
                }
                if ($list['aaa'] == "1") {
                        echo "Academic-All-American ";
                }
                if ($list['hof'] == "1") {
                        echo "Hall of Fame ";
                }
                echo ")</a></li>\n";
} // end while

?>
</ul>
<?php
}

function secure($string) {
	$string = strip_tags($string);
	$string = htmlspecialchars($string);
	$string = trim($string);
	$string = stripslashes($string);
	$string = $conn->real_escape_string($string);
	return $string;
}

// Do something with the form once it is posted
function process($val_input) {
	include("../config/settings.php");
	foreach ($val_input[0] as $value){
		$keyval = key($val_input[0]);
		$proc_input[0][$keyval] = secure($value);
		next($val_input[0]);
	}
	if ($proc_input[0][id] != "") {
		$sql = "UPDATE profile SET team = '".$proc_input[0][team]."', firstname = '".$proc_input[0][firstname]."', lastname = '".$proc_input[0][lastname]."', pos_event = '".$proc_input[0][pos_event]."', years = '".$proc_input[0][years]."', highschool = '".$proc_input[0][highschool]."', aa = '".$proc_input[0][aa]."', hof = '".$proc_input[0][hof]."', aaa = '".$proc_input[0][aaa]."', story = '".$proc_input[0][story]."', bests = '".$proc_input[0][bests]."' WHERE id = '".$proc_input[0][id]."'";
	} else {
		$sql = "INSERT INTO profile values ('".$proc_input[0][id]."', '".$proc_input[0][team]."', '".$proc_input[0][firstname]."', '".$proc_input[0][lastname]."', '".$proc_input[0][pos_event]."', '".$proc_input[0][years]."', '".$proc_input[0][highschool]."', '".$proc_input[0][aa]."', '".$proc_input[0][hof]."', '".$proc_input[0][aaa]."', '".$proc_input[0][story]."', '".$proc_input[0][bests]."');";
	}
	if(!$conn->query($sql)) {
		$dberror = $conn->error;
		echo "$dberror";
	}
	if ($proc_input[0][menu] != "") {
		$whereto = $_SERVER[PHP_SELF];
		header("Location: $whereto");
	}
	if ($proc_input[0][id] != "") {
		$photid = $proc_input[0][id];
	} else {
		$photid = $conn->insert_id;
	}
	$path = $basepath."/photos/".$photid.".jpg";
	?>
	<h1>Photo Editor</h1>
	<?php
	if (file_exists($path)) {
		echo "<img class=\"updImg\" src=\"../photos/".$photid.".jpg\"><br />";
	} else {
		echo "<img class=\"updImg\" src=\"../photos/nopict.jpg\"><br />";
	}
	?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
    <input type="hidden" name="op" value="photo">
    <input type="hidden" name="idpict" value="<?php echo $photid; ?>">

    <h3>Upload Image:</h3><br> <input type="file" name="imgfile"><br>
    <br>
    <input class="btn2" type="submit" value="Upload Image"><span class="rtnHome"> <a href="<?php echo $_SERVER[PHP_SELF]; ?>">Return Home Without Editing Photo</a></span>
    </form>
	<?
}

// Prompt photo upload

function photo($idpict,$imgfile,$imgfile_name,$imgfile_size,$imgfile_type) {

	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{
		// Uncomment for testing echo "$imgfile, $imgfile_name, $imgfile_size, $imgfile_type";
		/* SUBMITTED INFORMATION - use what you need
		* temporary filename (pointer): $imgfile
		* original filename           : $imgfile_name
		* size of uploaded file       : $imgfile_size
		* mime-type of uploaded file  : $imgfile_type
		*/

		/*== upload directory where the file will be stored relative to where script is run ==*/

		$uploaddir = "../photos";


		/*== get file extension (fn at bottom of script) ==*/
		/*== checks to see if image file, if not do not allow upload ==*/
		$pext = getFileExtension($imgfile_name);
		$pext = strtolower($pext);
		if (($pext != "jpg")  && ($pext != "jpeg"))
		{
			print "<h1>ERROR</h1>Image Extension Unknown.<br>";
			print "<p>Please upload only a JPEG image with the extension .jpg or .jpeg ONLY<br><br>";
			print "The file you uploaded had the following extension: $pext</p>\n";

			/*== delete uploaded file ==*/
			unlink($imgfile);
			exit();
		}


		//-- RE-SIZING UPLOADED IMAGE

		/*== only resize if the image is larger than 250 x 200 ==*/
		$imgsize = GetImageSize($imgfile);

		/*== check size  0=width, 1=height ==*/
		if (($imgsize[0] > 169) || ($imgsize[1] > 215))
		{
			/*== temp image file -- use "tempnam()" to generate the temp
			file name. This is done so if multiple people access the
			script at once they won't ruin each other's temp file ==*/
			$tmpimg = tempnam("/tmp", "MKUP");

			/*== RESIZE PROCESS
			1. decompress jpeg image to pnm file (a raw image type)
			2. scale pnm image
			3. compress pnm file to jpeg image
			==*/

			/*== Step 1: djpeg decompresses jpeg to pnm ==*/
			system("djpeg $imgfile >$tmpimg");

        		/*== Steps 2&3: scale image using pnmscale and then
			pipe into cjpeg to output jpeg file ==*/
			system("pnmscale -xy 169 215 $tmpimg | cjpeg -smoo 10 -qual 50 >$imgfile");

			/*== remove temp image ==*/
			unlink($tmpimg);
    		}

		/*== setup final file location and name ==*/
		/*== change spaces to underscores in filename  ==*/
		$final_filename = str_replace(" ", "_", $imgfile_name);
		$final_filename = "$idpict.jpg";
		$newfile = $uploaddir . "/$final_filename";

		/*== do extra security check to prevent malicious abuse==*/
		if (is_uploaded_file($imgfile))
		{

			/*== move file to proper directory ==*/
			if (!copy($imgfile,"$newfile"))
			{
				/*== if an error occurs the file could not
				be written, read or possibly does not exist ==*/
				print "Error Uploading File.";
				exit();
			}
		}

		/*== delete the temporary uploaded file ==*/
		unlink($imgfile);

//		print("<img src=\"../photos/$final_filename\">");

		/*== DO WHATEVER ELSE YOU WANT
		SUCH AS INSERT DATA INTO A DATABASE  ==*/
	}
}

// Present form for editing data

function edit($id) {
	include("../config/settings.php");
	if ($id != "") {
		$sql = "SELECT * FROM profile WHERE id=$id";
		$result = $conn->query($sql);

		while ($list = $result->fetch_array()) {
			$team = $list['team'];
			$firstname = $list['firstname'];
			$lastname = $list['lastname'];
			$pos_event = $list['pos_event'];
			$years = $list['years'];
			$highschool = $list['highschool'];
			$aa = $list['aa'];
			$hof = $list['hof'];
			$aaa = $list['aaa'];
			$story = $list['story'];
			$bests = $list['bests'];
		}
	}
	?>


	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          <input type="hidden" name="op" value="process">
	  <input type="hidden" name="val_input[0][which]" value="edit">
          <input type="hidden" name="val_input[0][id]" value="<?php echo $id; ?>">
<?php
	include("form.php");
}

// Display page and navigation

function page($currentpage) {
	include("../config/settings.php");

	// database connection info
//	$conn = new mysqli('localhost','ath_hof','qRt7Q9g8') or trigger_error("SQL", E_USER_ERROR);
//	$db = $conn->select_db('ath_hof') or trigger_error("SQL", E_USER_ERROR);

	// find out how many rows are in the table
	$sql = "SELECT COUNT(*) FROM profile";
	$result = $conn->query($sql) or trigger_error("SQL", E_USER_ERROR);
	$r = $result->fetch_row();
	$numrows = $r[0];

	// find out total pages
	$totalpages = ceil($numrows / $rowsperpage);

	// get the current page or set a default
	if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
   		// cast var as int
   		$currentpage = (int) $_GET['currentpage'];
	} else {
   		// default page num
   		$currentpage = 1;
	} // end if

	// if current page is greater than total pages...
	if ($currentpage > $totalpages) {
		// set current page to last page
		$currentpage = $totalpages;
	} // end if
	// if current page is less than first page...
	if ($currentpage < 1) {
		// set current page to first page
		$currentpage = 1;
	} // end if

	// the offset of the list, based on current page
	$offset = ($currentpage - 1) * $rowsperpage;

	// get the info from the db
	$sql = "SELECT id, firstname, lastname, team, aa, aaa, hof FROM profile ORDER BY lastname ASC, firstname ASC LIMIT $offset, $rowsperpage";
	$result = $conn->query($sql) or trigger_error("SQL", E_USER_ERROR);
?>
    <div id="topper">
    <div class="btn"><a href="<?php echo $_SERVER[PHP_SELF]; ?>?a=edit">+ Add New Athlete</a></div>
  </div>
<h1>Edit Athlete</h1>
<?php alpha(); ?>
<ul id="playerList">
<?php
	// while there are rows to be fetched...
	while ($list = $result->fetch_assoc()) {
		// echo data
		$team = $list['team'];
		echo "<li><a href=\"".$_SERVER[PHP_SELF]."?a=edit&id=".$list['id']."\">".$list['firstname']." ".$list['lastname']." - (";
		$sql2 = "SELECT * FROM sports WHERE id = '$team'";
		$result2 = $conn->query($sql2) or trigger_error("SQL", E_USER_ERROR);
		while ($list2 = $result2->fetch_assoc()) {
			echo "".$list2['sport']." ";
		}
		if ($list['aa'] == "1") {
			echo "All-American ";
		}
		if ($list['aaa'] == "1") {
			echo "Academic-All-American ";
		}
		if ($list['hof'] == "1") {
			echo "Hall of Fame ";
		}
		echo ")</a></li>\n";
} // end while
?>
</ul>
<?php
	/******  build the pagination links ******/
	// range of num links to show
	$range = 7;

	// if not on page 1, don't show back links
	if ($currentpage > 1) {
		// show << link to go back to page 1
		echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1'><<</a> ";
		// get previous page num
		$prevpage = $currentpage - 1;
		// show < link to go back to 1 page
		echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'><</a> ";
	} // end if

	// loop to show links to range of pages around current page
	for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
		// if it's a valid page number...
		if (($x > 0) && ($x <= $totalpages)) {
			// if we're on current page...
			if ($x == $currentpage) {
				// 'highlight' it but don't make a link
				echo " [<b>$x</b>] ";
				// if not current page...
			} else {
				// make it a link
				echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a> ";
			} // end else
		} // end if
	} // end for

	// if not on last page, show forward and last page links
	if ($currentpage != $totalpages) {
		// get next page
		$nextpage = $currentpage + 1;
		// echo forward link for next page
		echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>></a> ";
		// echo forward link for lastpage
		echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>>></a> ";
	} // end if
	/****** end build pagination links ******/

}

function getFileExtension($str) {

	$i = strrpos($str,".");
	if (!$i) {
		return "";
	}

        $l = strlen($str) - $i;
        $ext = substr($str,$i+1,$l);

        return $ext;

}

?>
<?php include("bottom.php"); ?>

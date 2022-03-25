<?php

// Read in submitted values via GET or POST depending page

$a = $_GET['a'];
$id = $_GET['id'];
$val_input = $_POST['val_input'];

// Test if OP is given to up via POST or GET and set value accordingly
if ($a == "")
{
	$op = $_POST['op'];
} else {
	$op = $a;
}

// Switch statement for carrying out request(s)

switch ($op) {
	case "page" :
		page();
		break;

	case "edit" :
		edit($id);
		break;

	case "process" :
		process($val_input);
		break;

	default :
		page();
		break;
}

function secure($string) {
	$string = strip_tags($string);
	$string = htmlspecialchars($string);
	$string = trim($string);
	$string = stripslashes($string);
	$string = $mysqli->real_escape_string($string);
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
	if ($proc_input[0][which] == "edit") {
		$sql = "UPDATE profile SET team = '".$proc_input[0][team]."', firstname = '".$proc_input[0][firstname]."', lastname = '".$proc_input[0][lastname]."', pos_event = '".$proc_input[0][pos_event]."', years = '".$proc_input[0][years]."', highschool = '".$proc_input[0][highschool]."', aa = '".$proc_input[0][aa]."', hof = '".$proc_input[0][hof]."', aaa = '".$proc_input[0][aaa]."', story = '".$proc_input[0][story]."', bests = '".$proc_input[0][bests]."' WHERE id = '".$proc_input[0][id]."'";
	} else {
		$sql = "INSERT INTO profile values ('".$proc_input[0][id]."', '".$proc_input[0][team]."', '".$proc_input[0][firstname]."', '".$proc_input[0][lastname]."', '".$proc_input[0][pos_event]."', '".$proc_input[0][years]."', '".$proc_input[0][highschool]."', '".$proc_input[0][aa]."', '".$proc_input[0][hof]."', '".$proc_input[0][aaa]."', '".$proc_input[0][story]."', '".$proc_input[0][bests]."');";
	}

	if(!$conn->query($sql)) {
		$dberror = $mysqli->error;
		echo "$dberror";
	}
	photo($proc_input);
}

// Prompt photo upload

function photo($proc_input) {

	echo "Process photo now";

}

// Present form for editing data

function edit($id) {
	include("../config/settings.php");
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
	?>

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          <input type="hidden" name="op" value="process">
	  <input type="hidden" name="val_input[0][which]" value="edit">
          <input type="hidden" name="val_input[0][id]" value="<?php echo $id; ?>">
<?php
	include("form.php");
}

// Display page and navigation

function page() {
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
	$sql = "SELECT id, firstname, lastname FROM profile ORDER BY lastname ASC, firstname ASC LIMIT $offset, $rowsperpage";
	$result = $conn->query($sql) or trigger_error("SQL", E_USER_ERROR);

	// while there are rows to be fetched...
	while ($list = $result->fetch_assoc()) {
		// echo data
		echo "<a href=\"".$_SERVER[PHP_SELF]."?a=edit&id=".$list['id']."\">".$list['firstname']." ".$list['lastname']."</a><br />";
} // end while

	/******  build the pagination links ******/
	// range of num links to show
	$range = 3;

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


?>

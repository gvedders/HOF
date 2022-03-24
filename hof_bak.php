<?php

$sport = $_GET['sport'];
$honor = $_GET['honor'];
$page = $_GET['page'];
$id = $_GET['id'];
$op = $_GET['op'];

if ($sport == "") {
	$sport = "0";
}

switch ($op) {
	case "splash" :
		splash();
		break;

	case "sport" :
		sport($honor);
		break;

	case "hof" :
		hof();
		break;

	case "names" :
		names($sport,$honor);
		break;

	case "profile" :
		profile($id);
		break;

	case "page" :
		page($honor, $sport, $currentpage);
		break;

	default :
		splash();
		break;
}

function splash() {
	// Display navigation for three HOF options
	echo "<a href=\"https://secure.aquinas.edu".$_SERVER['PHP_SELF']."?op=sport&amp;honor=aaa\">Academic All Americans</a><br />
	<a href=\"https://secure.aquinas.edu".$_SERVER['PHP_SELF']."?op=hof\">Hall of Fame</a><br />
	<a href=\"https://secure.aquinas.edu".$_SERVER['PHP_SELF']."?op=sport&amp;honor=aa\">All Americans</a><br />";
}

function hof() {
	// Setup query for hof search
	$honor = "hof";
	$sport = "0";
	$currentpage = "1";
	page($honor,$sport,$currentpage);
}

function sport($honor) {
	// List available sports for honor(s)
	include("config/settings.php");
	$n = 0;
	$result = mysql_query("SELECT * FROM sports ORDER BY sport ASC");
	while ($a_row = mysql_fetch_array($result)) {
		$id[$n] = $a_row['id'];
		$sport[$n] = $a_row['sport'];
		//echo "<a href=\"https://secure.aquinas.edu".$_SERVER['PHP_SELF']."?op=names&amp;sport=$id[$n]&amp;honor=$honor\">$sport[$n]</a><br />";
		$n++;
	}
	?><table>
	   <tr>
     <td valign="top">
	        <ul>
	<?php
	    $tot = count($id); 
	    $rows = $tot/2;
	    $rounded = round($rows);
	    $colmax = 2*$rounded;
	    for ($q = 0; $q < $rows; $q++) {
	    	echo "<li><a href=\"https://secure.aquinas.edu".$_SERVER['PHP_SELF']."?op=names&amp;sport=$id[$q]&amp;honor=$honor\">$sport[$q]</a></li>";

	    }
	    ?>
	        </ul>
	     </td>
	     <td valign="top">
	        <ul>
	     <?php 
		for ($q = $rows+1; $q < $colmax; $q++) {
			if ($id[$q] != "") {
	    		echo "<li><a href=\"https://secure.aquinas.edu".$_SERVER['PHP_SELF']."?op=names&amp;sport=$id[$q]&amp;honor=$honor\">$sport[$q]</a></li>";
			}
	    }
	     ?>
	     </ul></td>
	   </tr></table><?php 
}

function names($sport,$honor) {
	// Setup query for aa/aaa search
	$currentpage = "1";
	page($honor,$sport,$currentpage);
}

function profile($id) {
	// Return profile
	include("config/settings.php");
	$result = mysql_query("SELECT * FROM profile WHERE id ='$id'");
	while ($a_row = mysql_fetch_array($result)) {
		$id = $a_row['id'];
		$team = $a_row['team'];
		$firstname = $a_row['firstname'];
		$lastname = $a_row['lastname'];
		$pos_event = $a_row['pos_event'];
		$years = $a_row['years'];
		$highschool = $a_row['highschool'];
		$aa = $a_row['aa'];
		$hof = $a_row['hof'];
		$aaa = $a_row['aaa'];
		$story = $a_row['story'];
		$bests = $a_row['bests'];
	}
	$memberof = mysql_query("SELECT * FROM sports WHERE id = '$team'");
	while ($b_row = mysql_fetch_array($memberof)) {
		$sport = $b_row['sport'];
	}

	echo "$firstname $lastname<br /><br />TEAM: $sport<br />POSITION/EVENT: $pos_event<br />YEARS COMPETED: $years<br />HIGHSCHOOL: $highschool<br /></br >";

	if (($aa == "1") && ($aaa == "1") && ($hof == "1")) {
		echo "All Americian, Academic All American, Hall of Fame";
	}
	if (($aa == "1") && ($aaa == "1") && ($hof == "0")) {
		echo "All American, Academic All American";
	}
	if (($aa == "1") && ($aaa == "0") && ($hof == "1")) {
		echo "All American, Hall of Fame";
	}
	if (($aa == "1") && ($aaa == "0") && ($hof == "0")) {
		echo "All Americian";
	}
	if (($aa == "0") && ($aaa == "1") && ($hof == "1")) {
		echo "Academic All American, Hall of Fame";
	}
	if (($aa == "0") && ($aaa == "1") && ($hof == "0")) {
		echo "Academic All American";
	}
	if (($aa == "0") && ($aaa == "0") && ($hof == "1")) {
		echo "Hall of Fame";
	}

	echo "<br /><br />At Aquinas...$story<br />";if ($bests != "") { echo "Personal Bests: $bests"; }

}

function page($honor, $sport, $currentpage) {
	include("config/settings.php");

	// find out how many rows are in the table
	if ($honor != "hof") { 
		$sql = "SELECT COUNT(*) FROM profile WHERE team='$sport' AND $honor='1' ORDER BY lastname ASC, firstname ASC";
	} else {
		$sql = "SELECT COUNT(*) FROM profile WHERE $honor='1' ORDER BY lastname ASC, firstname ASC";
	}
	$result = mysql_query($sql, $conn) or trigger_error("SQL", E_USER_ERROR);
	$r = mysql_fetch_row($result);
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
	if ($honor != "hof") {
		$sql = "SELECT id, firstname, lastname FROM profile WHERE team='$sport' AND $honor='1' ORDER BY lastname ASC, firstname ASC LIMIT $offset, $rowsperpage";
	} else {
		$sql = "SELECT id, firstname, lastname FROM profile WHERE $honor='1' ORDER BY lastname ASC, firstname ASC LIMIT $offset, $rowsperpage";
	}
	
	$result = mysql_query($sql, $conn) or trigger_error("SQL", E_USER_ERROR);

	// while there are rows to be fetched...
	echo "<ul>\n";
	while ($list = mysql_fetch_assoc($result)) {
		// echo data
		echo "  <li><a href=\"".$_SERVER[PHP_SELF]."?op=profile&amp;id=".$list['id']."\">".$list['firstname']." ".$list['lastname']."</a></li>\n";
	} // end while
	echo "</ul>\n";
	if (mysql_num_rows($result) != 0) {	
	
		/******  build the pagination links ******/
		// range of num links to show
		$range = 3;

		// if not on page 1, don't show back links
		if ($currentpage > 1) {
			// show << link to go back to page 1
			echo " <a href='{$_SERVER['PHP_SELF']}?op=page&amp;currentpage=1&amp;sport=$sport&amp;honor=$honor'><<</a> ";
			// get previous page num
			$prevpage = $currentpage - 1;
			// show < link to go back to 1 page
			echo " <a href='{$_SERVER['PHP_SELF']}?op=page&amp;currentpage=$prevpage&amp;sport=$sport&amp;honor=$honor'><</a> ";
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
					echo " <a href='{$_SERVER['PHP_SELF']}?op=page&amp;currentpage=$x&amp;sport=$sport&amp;honor=$honor'>$x</a> ";
				} // end else
			} // end if 
		} // end for
                 
		// if not on last page, show forward and last page links        
		if ($currentpage != $totalpages) {
			// get next page
			$nextpage = $currentpage + 1;
			// echo forward link for next page 
			echo " <a href='{$_SERVER['PHP_SELF']}?op=page&amp;currentpage=$nextpage&amp;sport=$sport&amp;honor=$honor'>></a> ";
			// echo forward link for lastpage
			echo " <a href='{$_SERVER['PHP_SELF']}?op=page&amp;currentpage=$totalpages&amp;sport=$sport&amp;honor=$honor'>>></a> ";
		} // end if
		/****** end build pagination links ******/
	} else{ 
		echo "$noresultmessage";
	}
}

?>

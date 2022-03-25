<?php

$sport = $_GET['sport'];
$honor = $_GET['honor'];
$page = $_GET['page'];
$id = $_GET['id'];
$op = $_GET['op'];

include("design/top_mobile.php");

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
	include("design/main.php");
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
?>
<div id="returnHome"><a href="hof_mobile.php"><img src="images/backToMobile.jpg" width="309" height="78" /></a></div>
<div id="navigation">
    <div id="selectionHeader"><img src="images/selectSport.png" width="800" height="60" /></div>
<?php
	include("config/settings.php");
	$n = 0;
	$result = $mysqli->query("SELECT * FROM sports ORDER BY sport ASC");
	while ($a_row = $result->fetch_array()) {
		$id[$n] = $a_row['id'];
		$sport[$n] = $a_row['sport'];
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
	    	echo "<li><a href=\"".$_SERVER['PHP_SELF']."?op=names&sport=$id[$q]&honor=$honor\">$sport[$q]</a></li>";

	    }
	    ?>
	        </ul>
	     </td>
	     <td valign="top">
	        <ul>
	     <?php 
		for ($q = $rows+1; $q < $colmax; $q++) {
			if ($id[$q] != "") {
	    		echo "<li><a href=\"".$_SERVER['PHP_SELF']."?op=names&sport=$id[$q]&honor=$honor\">$sport[$q]</a></li>";
			}
	    }
	     ?>
	     </ul></td>
	   </tr></table></div><?php 
}

function names($sport,$honor) {
	// Setup query for aa/aaa search
	$currentpage = "1";
	page($honor,$sport,$currentpage);
}

function profile($id) {
	// Return profile
	include("config/settings.php");
	$result = $mysqli->query("SELECT * FROM profile WHERE id ='$id'");
	while ($a_row = $result->fetch_array()) {
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
	$memberof = $mysqli->query("SELECT * FROM sports WHERE id = '$team'");
	while ($b_row = $memberof->fetch_array()) {
		$sport = $b_row['sport'];
	}

?>


<div id="returnHome"><a href="hof_mobile.php"><img src="images/backToMobile.jpg" width="309" height="78" /></a></div>
<div id="profHeader"><img src="images/athleteProfile.png" width="830" height="60" alt="Profile" /></div>
    <div id="profile">
          <div id="photoCont">
              <div id="photo">
		<?php 
			$photopath = $path.$id.".jpg";
			if (file_exists($photopath)) {
			?>
				<img src="/photos/<?php echo "$id";?>.jpg" />
		<?php 
			} else { ?>
			  <img src="/photos/nopict.jpg" />
		<?php 
			} 
		?>               </div>

      </div>
          <div id="profInfo">

            <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td id="profTitle" colspan="2" valign="top"><?php echo "$firstname $lastname"; ?></td>
            </tr>
              <tr>
                <td class="subtitle">Team:</td>
                <td><?php echo "$sport"; ?></td>
              </tr>
              <tr>
                <td class="subtitle">Position/Event:</td>
                <td><?php echo "$pos_event"; ?></td>
              </tr>
              <tr>
                <td class="subtitle">Years Competed:</td>
                <td><?php echo "$years"; ?></td>
              </tr>
              <tr>
                <td class="subtitle">High School:</td>
                <td><?php echo "$highschool"; ?></td>
              </tr>
              <tr>
                <td class="subtitle">Honors:</td>
                <td>
<?php

	if (($aa == "1") && ($aaa == "1") && ($hof == "1")) {
		echo "All-American, Academic-All-American, Hall of Fame";
	}
	if (($aa == "1") && ($aaa == "1") && ($hof == "0")) {
		echo "All-American, Academic-All-American";
	}
	if (($aa == "1") && ($aaa == "0") && ($hof == "1")) {
		echo "All-American, Hall of Fame";
	}
	if (($aa == "1") && ($aaa == "0") && ($hof == "0")) {
		echo "All-American";
	}
	if (($aa == "0") && ($aaa == "1") && ($hof == "1")) {
		echo "Academic-All-American, Hall of Fame";
	}
	if (($aa == "0") && ($aaa == "1") && ($hof == "0")) {
		echo "Academic-All-American";
	}
	if (($aa == "0") && ($aaa == "0") && ($hof == "1")) {
		echo "Hall of Fame";
	}

?>
</td>
              </tr>
	<?php if ($story != "") {
	?>
              <tr>
                <td class="subtitle" colspan="2" ><br />At Aquinas:</td>
              </tr>
              <tr>
                <td colspan="2" class="smallText"><?php echo "$story"; ?></td>
              </tr> <?php } 
	if ($bests != "") {
	?>
               <tr>
                <td class="subtitle" colspan="2" ><br />Personal Bests:</td>
              </tr>
              <tr>
                <td colspan="2" class="smallText"><?php echo "$bests"; ?></td>
              </tr>
            </table>
<?php
	}

}

function page($honor, $sport, $currentpage) {
	include("config/settings.php");

?>
<div id="returnHome"><a href="hof_mobile.php"><img src="images/backToMobile.jpg" width="309" height="78" /></a></div>
<div id="navigation2">
                <div id="selectionHeader">
                    <img src="images/selectAthlete.png" width="400" height="60" />
                </div>
<?php

	// find out how many rows are in the table
	if ($honor != "hof") { 
		$sql = "SELECT COUNT(*) FROM profile WHERE team='$sport' AND $honor='1' ORDER BY lastname ASC, firstname ASC";
	} else {
		$sql = "SELECT COUNT(*) FROM profile WHERE $honor='1' ORDER BY lastname ASC, firstname ASC";
	}
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
	if ($honor != "hof") {
		$sql = "SELECT id, firstname, lastname FROM profile WHERE team='$sport' AND $honor='1' ORDER BY lastname ASC, firstname ASC LIMIT $offset, $rowsperpage";
	} else {
		$sql = "SELECT id, firstname, lastname FROM profile WHERE $honor='1' ORDER BY lastname ASC, firstname ASC LIMIT $offset, $rowsperpage";
	}
	
	$result = $conn->query($sql) or trigger_error("SQL", E_USER_ERROR);

	// while there are rows to be fetched...
	echo "<ul>\n";
	while ($list = $result->fetch_assoc()) {
		// echo data
		echo "  <li><a href=\"".$_SERVER[PHP_SELF]."?op=profile&id=".$list['id']."\">".$list['firstname']." ".$list['lastname']."</a></li>\n";
	} // end while
	// build three column table to house page navigation
	echo "</ul><div id=\"selectionFooter\"><table width=\"400\" cellspacing=\"0\" cellpadding=\"3\"><tr>\n";
	if ($result->num_rows != 0) {	
	
		/******  build the pagination links ******/
		// range of num links to show
		$range = 3;
		// turn on table col 1
		echo "<td width=\"140\" align=\"right\">";
		// if not on page 1, don't show back links
		if ($currentpage > 1) {
			// show << link to go back to page 1
			echo " <a class=\"lastPage\" href='{$_SERVER['PHP_SELF']}?op=page&currentpage=1&sport=$sport&honor=$honor'><img src=\"images/firstPage.png\" /></a> ";
			// get previous page num
			$prevpage = $currentpage - 1;
			// show < link to go back to 1 page
			echo " <a class=\"prevPage\" href='{$_SERVER['PHP_SELF']}?op=page&currentpage=$prevpage&sport=$sport&honor=$honor'><img src=\"images/prevPage.png\" /></a> ";
		} // end if 
		echo "</td><td width=\"120\" align=\"center\">";
?>
<?php if ($totalpages == 1) {echo "<div class=\"padFix2\">"; } ?>
<span class="navStyle"><?php echo "$currentpage"; ?> <span class="navItalics">of</span> <?php echo "$totalpages"; ?></span>
</td><td width="140" align="left"> 
<?php if ($totalpages == 1) {echo "</div>";} ?>
<?php                
		// if not on last page, show forward and last page links        
		if ($currentpage != $totalpages) {
			// get next page
			$nextpage = $currentpage + 1;
			// echo forward link for next page 
			echo " <a class=\"nextPage\" href='{$_SERVER['PHP_SELF']}?op=page&currentpage=$nextpage&sport=$sport&honor=$honor'><img src=\"images/nextPage.png\" /></a> ";
			// echo forward link for lastpage
			echo " <a class=\"lastPage\" href='{$_SERVER['PHP_SELF']}?op=page&currentpage=$totalpages&sport=$sport&honor=$honor'><img src=\"images/lastPage.png\" /></a> ";
		} // end if
		/****** end build pagination links ******/
	} else{ 
		echo "$noresultmessage";
	}
}
include("design/bottom.php");
?>

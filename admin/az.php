<?php
include("settings.php");

$sql = "SELECT * FROM profile WHERE lastname LIKE 'b%' ORDER BY lastname ASC";
$result = mysql_query($sql, $conn);
While ($list = mysql_fetch_array($result)) {
	echo "".$list['firstname']." ".$list['lastname']."\n";
}
?>

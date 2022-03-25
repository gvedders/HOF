<?php
include("../config/settings.php");

$sql = "SELECT * FROM profile WHERE lastname LIKE 'b%' ORDER BY lastname ASC";
$result = $conn->query($sql);
While ($list = $result->fetch_array()) {
	echo "".$list['firstname']." ".$list['lastname']."\n";
}
?>

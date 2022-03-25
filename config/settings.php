<?php

$host = "localhost";
$user = "ath_hof";
$passwd = "qRt7Q9g8";
$dbname = "ath_hof";

// Number of rows to show per page
$rowsperpage = 8;

// Display site or coming soon page (true for live)
$live = "true";

// No result error message
$noresultmessage = "<td align=\"center\" class=\"underConst\">This section is under construction, please check back soon as new information is added daily.</td></tr></table>";

// Stop editing at this point

$conn = new mysqli($host, $user, $passwd);
$db = $conn->select_db($dbname);
?>

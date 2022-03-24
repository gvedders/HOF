<?php

$host = "localhost";
$user = "ath_hof";
$passwd = "qRt7Q9g8";
$dbname = "ath_hof";

// Number of rows to show per page
$rowsperpage = 30;

// Stop editing at this point

$conn = mysql_connect($host, $user, $passwd);
$db = mysql_select_db($dbname,$conn);
?>

<?php

$host = "localhost";
$user = "ath_hof";
$passwd = "qRt7Q9g8";
$dbname = "ath_hof";

// Number of rows to show per page
$rowsperpage = 8;

// No result error message
$noresultmessage = "<td align=\"center\" class=\"underConst\">This section is under construction, please check back soon as new information is added daily.</td></tr></table>";

// Stop editing at this point

$conn = mysql_connect($host, $user, $passwd);
$db = mysql_select_db($dbname,$conn);
?>

<?php
  // Landing patch - coming soon messages / actual site
  if ($live = "true") {
    include("hof.php");
  } else {
    include("index.html");
  }
?>

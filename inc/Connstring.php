<?php 

$mysqli = new mysqli('localhost', 'saeald12', 'jTZWRRWdIc', 'saeald12_db'); 
if (mysqli_connect_error()) { 
   echo "Connect failed: " . mysqli_connect_error(). "<br>"; 
   exit(); 
} 

$mysqli->set_charset("utf8"); 



?> 

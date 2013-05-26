<?php 


session_start(); 

$_SESSION = array();

session_unset();
session_destroy();

$loc2 = $_GET['page'];

header("Location: {$loc2}.php");

?> 


<?php 
session_start(); 
date_default_timezone_set("Europe/Stockholm");

$loc = basename($_SERVER["PHP_SELF"], ".php");

$adminHTML= "";





//Login status
if(isset($_SESSION['user'])){
	$adminHTML = <<<END
	<div style="padding-top:3%;">
	<div class="alert alert-info pull-right fixed-top" >
	<p>you are logged in as <strong class="label label-important">{$_SESSION["user"]}</strong> &nbsp; <a class="label label-success" href="logout.php?page={$loc}">Logout</a><p>
</div>
	</div>
END;
}
 

$header = <<<BEGIN
<!DOCTYPE html>
<html lang="en">
<head>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="./img/ico.ico" rel="icon" type="image/x-icon" />
<title>DefJam-Security</title>
<link rel="stylesheet" href="./css/bootstrap.css" type="text/css">
<link rel="stylesheet" href="./css/bootstrap-responsive.css" type="text/css">
<link rel="stylesheet" href="./css/mall.css" type="text/css"> 

</head>

   
   
<body>
 
 



<div class="navbar navbar-fixed-top navbar-inverse"> 
<div class="navbar navbar-inner"> 
<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
<span class="icon-bar"> </span>
<span class="icon-bar"> </span>
<span class="icon-bar"> </span>
</a>
<a style="color:#FFFFFF" class="brand farg" href="index.php"> Defjam-Security </a> 
<div class="nav-collapse">
<ul class="nav"> 
<li><a href="index.php"><i class="icon-home icon-white"></i>Home</a></li>
<li> <a href="how.php"> How-to </a> </li>
<li class="dropdown"> 
<a href="#" class="dropdown-toggle" data-toggle="dropdown">Submit Sum <b class="caret"></b></a>
<ul class="dropdown-menu">
<li> <a href="file.php">From File</a> </li>
<li> <a href="submit.php">Manually</a> </li>
</ul>
</li>
<li> <a href="list.php"> List-Sums </a> </li> 
<li> <a href="contact.php"> Contact us</a> </li>
</ul>


<form class="navbar-search pull-right" action="find.php" method="post">
<label class="label label-inverse">Search By:</label>
<select style="width:95px; height:25px; id="smethod" name="smethod">
<option value= "1" > MD5Sum </option> 
<option value = "2"> Program Name </option> 
</select> 

<input class="search-query span3" type="text" name="search" placeholder="Search"> </input>

</form> 
</div>
</div>
</div>
{$adminHTML}
<div class="container span8" style="padding-top:3%;" > 



BEGIN;



$footer = <<<BEGIN


<br>
<footer class="navbar-fixed-bottom">

<p> &copy; Defjam-Security 2013 </p>


</footer>

</div>



<script src="http://code.jquery.com/jquery.js"></script>
<script src="./js/bootstrap.js"></script>
<script src="./bootstrap-buttons.js"</script>
</body> 

</html>

BEGIN;

?>  
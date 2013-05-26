<?php 

date_default_timezone_set("Europe/Berlin");
require("inc/HTMLTemplate.php"); 

if(!isset($_SESSION["user"])) {
	header("Location: index.php");
	exit();
	}
	
include_once("inc/Connstring.php"); 

$tmd5base = "MD5Base"; 


$md5sum = isset($_GET['pid']) ? $_GET['pid'] : ''; 

$s = isset($_GET['s']) ? $_GET['s'] : '' ; 

if($md5sum == '') {
	$content = <<<END
			<div id="breadcrumbs"> 
			<p><a href="list.php">back to list</a> &gt; Delete </p> 
			</div> 
			<div> 
			<p> No data has been chosen. Please Try Again.</p> 
			</div> 
END;



} else if ($s != '') {
	
	
	if($md5sum != '') {
		$md5sum= $mysqli->real_escape_string($md5sum);
		$type = "HashData"; 
		
		//Sql query 
		$query = <<<END
		
		DELETE FROM {$tmd5base}
		WHERE MD5Sum = '{$md5sum}';

END;



}


 $mysqli->query($query) or die ("Could not query database" . $mysqli->errno . " : " . $mysqli->error);

 if(($mysqli->affected_rows) >= 1) {
	$feedback = "The {$type} has been removed.";
	
	} else {
		$feedback = "Something went wrong and the {$type} was not removed."; 
	}
	
	$mysqli->close();
	
	
	$content = <<<END
		<div id="breadcrumbs"> 
		<p> <a href="list.php">List-Sums </a> &gt; Delete</p> 
		</div> 
		<div class="well">
		<div class="alert alert-block alert-success">
		<p>{$feedback}</p> 
		<p><a href="list.php" class="btn btn-success">Back to list-sums</a> </p> 
		</div>
		</div>
		
END;



} 

 else {
	$type = ($md5sum != '') ? "hashdata" : "hashdata" ;
	
	$content = <<<END
	<div id="breadcrumbs">
	<p><a href="list.php">back to list </a> &gt; Delete </p> 
	</div>
	<div class="well">
	<div class="alert alert-block alert-error"> 
	<p> Are you sure you want to remove the chosen {$type}? </p> 
	<p> <a href="gb-delete.php?pid={$md5sum}&s=y" class="btn btn-danger">Yes</a></p>
	</div> 
	</div>
END;
} 

echo $header;
echo $content; 
echo $footer; 
?> 

	
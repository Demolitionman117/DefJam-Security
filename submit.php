<?php
include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php"); 

$tmd5base = "MD5Base"; 
$md5sum = "";
$progname=""; 
$downsite=""; 
$desc= ""; 
$version = "";
$feedback1 = ""; 
$feedback2="";
$content = "";
$md5sumf = "";

if(!empty($_POST)) {

	$md5sum = isset($_POST['md5sum']) ? $_POST['md5sum'] : ''; 
 	$progname = isset($_POST['progname']) ? $_POST['progname'] : ''; 
	$downsite = isset($_POST['downsite']) ? $_POST['downsite'] : '';
	$desc = isset($_POST['desc']) ? $_POST['desc'] : ''; 
	$version = isset($_POST['version']) ? $_POST['version'] : ''; 
	$spamTest = isset($_POST['spam']) ? $_POST['spam'] : ''; 
//Robot spam test.
	if($spamTest != '') { 
		die("I think you are a robot. if you are not, go back and try again."); 
	} 

			
//Convert progname to uppercase
$progname = strtoupper($progname);

//Controll of fileds and feedback.
if($md5sum == '' || $progname == '' || $desc == '') { 
		$feedback1 = "<p class=\"label label-important\"> Please fill out all fileds.</p>";
		 } 
//Controll hashvalue length		
elseif (strlen($md5sum) < 32 || strlen($md5sum) > 40 ){
	$md5sumf = "<p class=\"alert alert-error\"> Type a valid Hashsum!!</p>";
	} 
	 
	else { //Sql inj, prevent.
	$md5sum = utf8_encode($mysqli->real_escape_string($md5sum));
	$progname = utf8_encode($mysqli->real_escape_string($progname));
	$version = utf8_encode($mysqli->real_escape_string($version));
	$downsite = utf8_encode($mysqli->real_escape_string($downsite));
	$desc = utf8_encode($mysqli->real_escape_string($desc));
	
	
	//SQL Query
	$query = <<<BEGIN
	--
	-- Inserts new data into DB 
	--
	INSERT INTO {$tmd5base} (MD5Sum, programName, downloadSite, description, version)
	VALUES ('{$md5sum}', '{$progname}', '{$downsite}', '{$desc}', '{$version}')
	ON DUPLICATE KEY UPDATE submitDate=CURRENT_TIMESTAMP; 
BEGIN;

$mysqli->query($query) or die ("Could not query database" . $mysqli->errno . " : " . $mysqli->error);
$feedback2 = <<<END
	   
		<div class="well">
		<div class="alert alert-block alert-success">
		<p> Thank You, your data has been saved.</p>
		<p> <a href="list.php" class="btn btn-success">List Sums</a></p> 
		</div>
		</div> 
		
END;


	}
} 

$content = <<<BEGIN
	<div class="well"> 
	<legend> Submit Values Manually </legend>
	{$feedback1}
	
	<div class="pull-right span4"><legend> Help </legend> <p>
	Fill all Filed you want to publish<br> to our database<br>
	instructions<br> about how to generate<br> md5sum manually<br> is found 
	<a class="btn-small btn-info" href="inst.php">Here </a><br> or you can generate it auto.
	<a class="btn-small btn-warning" href="file.php">Here</a>
	</p></div>
	<form action="submit.php" method="post"> 
  	  <label for="md5sum" > Md5Sum-Value: </label> 
	  <input class="span5" type="text" id="md5sum" name="md5sum" value="" required/> {$md5sumf}
	  <input type="text" id="spam" name="spam" style="display: none;" /> 
	  <label for="progname"> Program Name: </label>
	  <input class="span5"  type="text" id="progname" name="progname" required/>
	  <label for="version"> Program Version: </label> 
	  <input class="span5"  type="text" id="version" name="version" required/> 
	  <label for="downsite"> Download Site: </label>
	  <input class="span5" type="text" id="downsite" maxlength="65" name="downsite"/> 
	  <label for="desc"> Description:</label> 
	  <textarea class="span6"  id="desc" name="desc" rows="6" cols="100" required></textarea> 
	  <div>  <input class="btn btn-success" type="submit" value="Submit-Value" /> </div>  
 </form> 
</div> <!-- container --> 

BEGIN;

if($feedback2 != ''){
	$content = '';
}


$mysqli->close();


echo $header;
echo $content;
echo $feedback2;
echo $footer;

?> 



<?php  

include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php"); 

$tmd5base = "MD5Base"; 
$content = "";
$feedback = "";
$md5value = "";
$filename = "";
$sizemes = "";

$filesize = isset($_POST['MAX_FILE_SIZE']) ? $_POST['MAX_FILE_SIZE'] : ''; 



//error controll file upload
if ($_FILES["file"]["error"] > 0)
  {
  $feedback= "Error: " . $_FILES["file"]["error"] . "<br>";
  }
  //Upload process
  else
  {
$md5value = md5_file($_FILES['file']['tmp_name']);
$filename = $_FILES['file']['name'];
 
 $feedback = <<<END
 <div>
 <p class="label label-info">Generated Successfully:</p> 
 <p> The generated md5sum of: <span class="label label-warning">{$filename}</span> is <span class="label label-success">{$md5value}</span> </p> 
</div> 

END;

} 




$content =<<<END
<div class="well"> 
{$sizemes}
{$feedback}
<form action="submit.php" method="post"> 
  	  <input class="span5" type="hidden" id="md5sum" name="md5sum" value="{$md5value}"/>
	  <input type="text" id="spam" name="spam" style="display: none;" /> 
	  <input class="span5"  type="hidden" id="progname" name="progname" value="{$filename}" required/>
	  <label for="version"> Program Version: </label>
	  <input class="span5"  type="text" id="version" name="version" required/> 
	  <label for="downsite"> Download Site: </label>
	  <input class="span5" type="text" id="downsite" maxlength="65" name="downsite"/> 
	  <label for="desc"> Description:</label> 
	  <textarea class="span6"  id="desc" name="desc" rows="6" cols="100" required></textarea> 
	  <div>  <input class="btn btn-success" type="submit" value="Submit to database" />
			<a href="file.php" class="btn btn-warning">Go Back </a></div>
	
 </form> 
</div> 
END;













echo $header; 
echo $content;
echo $footer; 


?> 
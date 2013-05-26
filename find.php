<?php
include_once("inc/HTMLTemplate.php");
include_once("inc/Connstring.php"); 

$tmd5base = "MD5Base";
$content = ""; 
$md5sum = "";
$progname="";
$basvar = "";

if(!empty($_POST)) {

$search= isset($_POST['search']) ? $_POST['search'] : '';
$smethod= isset($_POST['smethod']) ? $_POST['smethod'] : '';



if($smethod == "1") {
$basvar = "MD5sum"; 
}

//Convert search value 
if($smethod == "2") {
$basvar= "programName";
$search = strtoupper($search);
}



//list search value 
$query= <<<END

SELECT MD5Sum, programName, version, description, submitDate FROM {$tmd5base} 
WHERE {$basvar} like '{$search}' 
ORDER BY {$basvar};

END;


$res = $mysqli->query($query) or die("Could not query dtabase" . $mysqli->errno. " : " .$mysqli->error);


$content = <<<END
<table class="table table-hover table-bordered">
<tr> 
<th>MD5Sum: </th> 
<th> Program Name:	</th> 
<th> Program Version:	</th> 
<th> Description: </th> 
<th> Last-Verified:</th> 
</tr>
END;


//loops through results  
while($row = $res->fetch_object()) { 
	$date = strtotime($row->submitDate);
	$date = date(" H:i d M Y ", $date); 

	$md5sum  = utf8_decode(htmlspecialchars($row->MD5Sum));
	$progname = utf8_decode(htmlspecialchars($row->programName));
	$version = utf8_decode(htmlspecialchars($row->version));
	$desc = utf8_decode(htmlspecialchars($row->description));
	
	
	$content .= <<<END
	<tr>
	<td>{$md5sum} </td>
	<td>{$progname}</td>
	<td> {$version}</td> 
	<td>{$desc} </td> 
	<td> {$date} </td> 
	</tr>
	
END;
} 
$content .= "</table> ";

//Search resualt feedback.
if ($md5sum == '' && $progname == '' ) {
$content = <<<END
<div class="well"> 
<h3 class="label label-important"> Sorry your search term "{$search}" was not found! </h3> 
</div> 
 
END;
}

}



$res->close();
$mysqli->close();

echo $header;
echo $content;
echo $footer;


?> 
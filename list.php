<?php
include_once("inc/TableTemplate.php");
include_once("inc/Connstring.php"); 


$tmd5base = "MD5Base";
$content = ""; 

//List Database lists. 

//List query
$query= <<<END

SELECT MD5Sum, programName, version, downloadSite, description, submitDate
FROM {$tmd5base}
ORDER BY submitDate DESC;
 
END;

$res = $mysqli->query($query) or die("Could not query dtabase" . $mysqli->errno. " : " .$mysqli->error); 


$content = <<<END
<legend> Current HashValues In DataBase </legend>
<div style="padding-top:10%;">
<table class="table table-hover table-bordered">

<tr> 
<th>MD5Sum: </th> 
<th> Program Name:	</th> 
<th> Program Version:	</th> 
<th> Download Site: </th> 
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
	$downsite = utf8_decode(htmlspecialchars($row->downloadSite));
	$desc = utf8_decode(htmlspecialchars($row->description));
	
	//For deleting posts
$adminRow="";
if(isset($_SESSION["user"])){
	$adminRow = <<<END
	<td><p class="btn"><a href="gb-delete.php?pid={$row->MD5Sum}">Delete</a></p> </td>
END;
} 

	
	$content .= <<<END
	<tr>
	<td>{$md5sum}</td> 
	<td>{$progname}</td>
	<td> {$version}</td> 
	<td> <a href="{$downsite}" target="_blank">{$downsite}</a> </td> 
	<td>{$desc} </td> 
	<td>{$date} </td> 
	{$adminRow}
	</tr>
	
	
END;
} 
$content .= "</table> </div>";

$res->close();
$mysqli->close();

echo $header;
echo $content;
echo $footer;

 



?>
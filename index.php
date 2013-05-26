<?php
include_once("inc/HTMLTemplate.php"); 


$content = <<<END
<div> <img class= "ram" src="img/Security.jpg" alt="Security-logo">   </div>   
<div class="linje"> </div>
<div class="well"> <h2> Defjam-Security </h2> 
<p> On Defjam-security you can test your files integrity easily and fast you can even submit values by yourself. </p>
<p> We are using a technology called hashsums, A hash function is any algorithm or subroutine that maps data sets of variable length to data sets of a fixed length. For example, a person's name, having a variable length, could be hashed to a single integer. The values returned by a hash function are called hash values, hash codes, hash sums, checksums or simply hashes.  </div> 

END;
 

echo $header;
echo $content;
echo $footer;

?> 
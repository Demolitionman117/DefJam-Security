<?php
include_once("inc/HTMLTemplate.php");

$content = <<<END
<div class="hero-unit"> <h1> How To </h1> 
<p> On this site you will find descriptions about MD5sums and how to use them </p> </div>  
<div class ="row"> 
<div class="span4 offset1"> 
<h2> What is MD5sum? </h2> 
<p> md5sum is a computer program that calculates and verifies 128-bit MD5 hashes. The MD5 hash (or checksum) functions as a compact digital fingerprint of a file.</p> 
<p><a class="btn" href="http://en.wikipedia.org/wiki/Md5sum" target="_blank"> Read more </a> </p>
</div> 
<div class="span4 offset1"> 
<h2> How do I do? </h2> 
<p> This instructions depends on which operating system you are using, with windows you need a specfic program to generete the md5sums while in linux its a build in function called md5sum.</p>
<p><a class="btn" href="inst.php"> Read more </a> </p> 
</div>
</div> 
END;

echo $header;
echo $content;
echo $footer;

?> 


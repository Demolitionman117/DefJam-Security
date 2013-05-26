<?php
include_once("inc/HTMLTemplate.php");

$content = <<<END
<div class="well"> 
<h2 class="label label-info"> Instructions Windows </h2> 
<ol>
<li> first you need to download the md5sums software from 
<a href="http://www.pc-tools.net/win32/md5sums/" target="_blank" class="btn btn-mini btn-info"> md5sum freeware </a></li>
<li> when you have downloaded the software, extract it somewhere on the desktop or the C: drive</li>
<li> press windowsbutton+r then type in cmd </li> 
<li> when the cmd prompt ( a black window) comes up type in <strong> cd </strong> followed by the directory where you extracted the md5sums software </li>
<li> in the directory type <strong> md5sums </strong> follwed by the <strong> directory </strong> of the file you want to evalute </li> 
<li> when all that is done, save the hashsum generated and upload it do our server or compare it with another sum if it alredy exists </li> 
<ol>
</div> 
<div class="linje"> </div> 
<div class="well"> 
<h2 class="label label-warning"> Instructions Linux </h2> 
<ol> 
<li> just start the command-prompt and type <strong> cd </strong> follwed by the <strong> directory </strong> of the file you want to verify </li> 
<li> when you are in the directory type </strong> md5sum </strong> follwed by the <strong> name </strong> of the file.</li>
<li> now you are done, submit the sum on our website or compare it with other sums if exist.</li> 
</ol> 
</div> 

END;


echo $header; 
echo $content;
echo $footer;

?> 
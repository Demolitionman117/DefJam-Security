<?php
include_once("inc/HTMLTemplate.php");



$content = <<<END
<div class="well"> 
<form id="upload" action="upload.php" method="post" enctype="multipart/form-data">
<fieldset> 
<div class="pull-right"> <legend>Help </legend> 
<p> With this function you can upload any file<br> and generate a md5checksum<br>
 without any interaction with your computer.<br>
 press the button if you like to generate it 
 <a href="submit.php" class="btn-small btn-warning"> Manually </a></p> </div> 
<legend> Md5 generator from file </legend> 
<input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="32428800"/>
<label for="fileselect"> Select File:</label>
<input type="file" id="file" name="file" required/> 
<p> (MaxSize 30Mb)</p>
<div> 
<button class="btn btn-success" type="submit" value="generate" data-loading-text="Generating...">Generate</button>
</div>

</div>


END;


echo $header;
echo $content;
echo $footer;

?> 
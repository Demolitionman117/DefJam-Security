<?php
include_once("inc/HTMLTemplate.php");
$content = '';

foreach($_POST as $value) {
	if(stripos($value, 'Content-Type:') !== FALSE) {
		echo "Something went wrong, please try again.";
		exit;
	}
}

if(!empty($_POST)){
	$name = 	isset($_POST['name']) ? $_POST['name'] : '';
	$email = 	isset($_POST['email']) ? $_POST['email'] : '';
	$msg = 		isset($_POST['msg']) ? $_POST['msg'] : '';
	
	if($_POST['answer'] != ""){
		
		die("I think you're a robot. If you're not, go back and try again.");
	}
	
	if($name == '' || $email == '' || $msg == '') {
		$form = formHTML($name, $email, $msg);
		
		$content = <<<END
		<div>
		<p class="label label-important">Please Fill All Fields!</p>
		<div>
		{$form}		
END;

	
	} else{
		
		$to = 'nicahl12@student.hh.se';
		$subject = 'Kontaktformulär | '.$name;
		$headers = "MIME-Version: 1.0" . "\r \n";
		$headers .= "Content-type:text/html;charset=utf-8" . "\r\n";
		$headers .= "From: {$email}" . "\r\n";
		$headers .= "Reply-To: {$email}";
		
	if(mail($to, $subject, $msg, $headers)){
		$content = <<<END
			
			<div class="alert alert-block alert-success">
			Thank your, the message has been sent!<br>
			<a href="contact.php" class="btn btn-success">Go Back</a>
			</div>
			
END;
	}
	else{
		$content = <<<END

			The Message did not go away... :(<br>
			<a href="contact.php">go back</a>
END;
	}
	
	}

} else{
	
	$form = formHTML();
	
	$content = <<<END
		
			{$form}
END;

}

function formHTML($name = "", $email = "", $msg =""){
	$name = htmlspecialchars($name);
	$email = htmlspecialchars($email);
	$msg = htmlspecialchars($msg);
	
	return <<<END
	<legend><h2> Contact Us </h2> </legend>
	<div class="well"> 
	<form action="contact.php" method="post">
		<p><label for="name">Name:</label>
		<input type="text" id="name" name="name" value="{$name}"></p>
		<p><label for="email">E-mail:</label>
		<input type="email" id="email" name="email" value="{$email}"></p>
		<input style="display:none;" type="text" id="answer" name="answer" value="">
		<p><label for="msg">Message:<br></label>
		<textarea id="msg" name="msg" rows="6" cols="90">{$msg}</textarea></p>
		<div><input class="btn btn-warning" type="submit" value="Send"></div>
	</form>	
	</div>
	
END;
}

echo $header;
echo $content;
echo $footer;
?>
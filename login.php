<?php
include_once("inc/HTMLTemplate.php");
date_default_timezone_set("Europe/Stockholm");
$error = '';



if(!empty($_POST)){
	include_once("inc/Connstring.php");
	$table = "dadmin";
	
	$user = isset($_POST['username']) ? $_POST['username'] : '';
	$passwd = isset($_POST['password']) ? $_POST['password'] : '';
	
	
	if($user == '' || $passwd == '') {
		$error = "<p class=\"label label-important\" > Please Sir! Fill All Fileds </p>" ;
		
	}
	else {
		//$user = htmlspecialchars($user);
		//$password = htmlspecialchars($passwd);
		
		$user = $mysqli->real_escape_string($user);
		$password = $mysqli->real_escape_string($passwd);
		
		$query = <<<END
			SELECT username, password, adminId
			FROM {$table}
			WHERE username = "{$user}";
		
END;

		$res = $mysqli->query($query) or die("Could not query database" . $mysqli->errno . " : " . $mysqli->error); //Performs query
		
		if($res->num_rows == 1) {
			$row = $res->fetch_object();
			$pswmd5 = md5($password);
			if($row->password == $pswmd5){
			
			session_start();
				//session_regenerate_id();
			$_SESSION['user'] = $user;
			$_SESSION['userId'] = $row->adminId;
				
				
				header("Location: index.php");
			}
			else {
				$error = "<p class=\"label label-important\" >Password is incorrect</p>";
			}
		 
		}
		else {
			$error = "<p class=\"label label-important\" >Username is incorrect</p>";
		}
		$res->close();
		$mysqli->close();
	}
}



$content = <<<END
	{$error}
	<div class="well">
		<form action="login.php" method="post" id="login-form">
		<label for="username">Användarnamn:</label>
		<input type="text" id="username" name="username" value""><br>
		<label for="passwod">Lösenord:</label>
		<input type="password" id="password" name="password" value""><br>
		<div>
		<input class="btn btn-inverse"type="submit" value="Login">
		</div>
	</div>
	
END;

echo $header;
echo $content;
echo $footer;

?>
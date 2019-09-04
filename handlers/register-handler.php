<?php

function sanitizeFormPassword($inputtext){
	$inputtext=strip_tags($inputtext);
	return $inputtext;
}

function sanitizeFormUsername($inputtext){
	$inputtext=strip_tags($inputtext);
	$inputtext=str_replace(" ","", $inputtext);
	return $inputtext;
}

function sanitizeFormString($inputtext){
	$inputtext=strip_tags($inputtext);
	$inputtext=str_replace(" ","", $inputtext);
	$inputtext=ucfirst(strtolower($inputtext));
	return $inputtext;
}


if(isset($_POST['registerButton'])) {
	//register button was pressed
	$username=sanitizeFormUsername($_POST['username']);
	$firstName=sanitizeFormString($_POST['firstName']);
	$lastName=sanitizeFormString($_POST['lastName']);
	$email=sanitizeFormString($_POST['email']);
	$email2=sanitizeFormString($_POST['email2']);
	$password=sanitizeFormPassword($_POST['password']);
	$password2=sanitizeFormPassword($_POST['password2']);
	$wasSuccessful=$account->register($username,$firstName,$lastName,$email,$email2,$password,$password2);
	if($wasSuccessful == true){
		$_SESSION['userLoggedIn']=$username;
		$query = "SELECT id FROM users WHERE username=?";
		$stmt = $con->prepare($query);
		$stmt->bind_param('s',$username);
		$stmt->execute();
		$stmt->bind_result($cun);
		$stmt->fetch();
		$_SESSION['userId']=$cun;
		header("Location:browse.php");
	}
}

?>

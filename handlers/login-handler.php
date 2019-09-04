<?php
if(isset($_POST['loginButton'])) {
	$username=$_POST['loginUsername'];
	$password=$_POST['loginPassword'];
$result=$account->login($username,$password);
if ($result==true){
	session_start();
	$_SESSION['userLoggedIn']=$username;
	$query = "SELECT id FROM users WHERE username=?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('s',$username);
    $stmt->execute();
    $stmt->bind_result($cun);
    $stmt->fetch();
    $_SESSION['userId']=$cun;
	header("Location: browse.php");
}
}
?>
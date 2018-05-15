<?php
	session_start();
	require "../../vendor/autoload.php";

	use Codetech\database;
	use Codetech\Bcrypt;

	$username = $_POST['username'];
	$password = $_POST['password'];

	$db = new database;

	$hash = $db->selectNow("users","password","username",$username);

	if( $hash != null || $hash != "" ) {
		 if( Bcrypt::checkPassword($password,$hash) ) {
		 	$_SESSION['userId'] = $db->selectNow('users','id','username',$username);
		 	header("Location: ../index-new.php");
		 }else {
		 	header("Location: login.php?error=Authetication Error!");
		 }	
	}else {
		header("Location: login.php?error=Authentication Error!");
	}
?>

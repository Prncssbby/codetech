<?php
	
	require "../../vendor/autoload.php";
	use Codetech\database;
	use Codetech\Bcrypt;
	
	$username = $_POST['username'];
	$password = $_POST['password'];

	$ro = new database;


	$data = array(
			"username" => $username,
			"password" => Bcrypt::hashPassword($password),
			"dateRegister" => date('Y-m-d H:i:s')
			);

	$ro->insertNow("users",$data);
	
	header("Location: ../index-new.php");

?>
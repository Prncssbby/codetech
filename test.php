<?php

	include "class/database.php";
	include "class/Bcrypt.php";

	$ro = new Codetech\database();


	$data = array(
			"username" => "test",
			"password" => Bcrypt::hashPassword("ediWow"),
			"dateRegister" => date('Y-m-d H:i:s')
			);

	$ro->insertNow("users",$data);

?>
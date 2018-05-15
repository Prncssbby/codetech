<?php 

require "../session/session.php";
require "../vendor/autoload.php";

use Codetech\database;

$db = new database;

if( !isset($_POST['location']) ) {
	$location = 'uploads/'.$_POST['folderName'];
}else {
	$location = $_POST['location'].$_POST['folderName'];
}

if(!isset($_POST['parentId'])) {
	$parentId = 0;
}else {
	$parentId = $_POST['parentId'];
}

$data = array(
		"ownerId" => $_SESSION['userId'],
		"name" => $_POST['folderName'],
		"location" => $location,
		"parent" => $_SESSION['currentPath'],
		"parentId" => $parentId,
		"dateCreated" => date('Y-m-d H:i:s'),
		"status" => 'active'
	);

$db->insertNow('folders',$data);

$old = umask(0);
mkdir($location);
umask($old);

header("Location: ".$_POST['returnPage']);
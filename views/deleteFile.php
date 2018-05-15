<?php

require "../session/session.php";
require "../vendor/autoload.php";

use Codetech\database;


$fileId = $_POST['fileId'];

$db = new database;

$location = $db->selectNow("files","location","id",$fileId);
$name = $db->selectNow("files","name","id",$fileId);

//echo "uploads/Trash/".$name;
//die();
rename($location, "uploads/Trash/".$name);
$db->editNow("files","id",$fileId,"status","deleted");

?>
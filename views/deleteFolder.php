<?php

require "../session/session.php";
require "../vendor/autoload.php";

use Codetech\database;


$folderId = $_POST['folderId'];

$db = new database;

$location = $db->selectNow("folders","location","id",$folderId);
$name = $db->selectNow("folders","name","id",$folderId);

//echo "uploads/Trash/".$name;
//die();
rename($location, "uploads/Trash/".$name);
$db->editNow("folders","id",$folderId,"status","deleted");

?>
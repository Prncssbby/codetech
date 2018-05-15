<?php

require "../session/session.php";
require "../vendor/autoload.php";

use Codetech\database;


$folderId = $_POST['folderId'];
$name = $_POST['name'];

$db = new database;

$location = $db->selectNow('folders','location','id',$folderId);

$newLocation = str_replace($db->selectNow('folders','name','id',$folderId),$name,$location);

rename($location,$newLocation);
$db->editNow("folders","id",$folderId,"location",$newLocation);
$db->editNow("folders","id",$folderId,"name",$name);


?>
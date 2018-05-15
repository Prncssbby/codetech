<?php

require "../session/session.php";
require "../vendor/autoload.php";

use Codetech\database;


$fileId = $_POST['fileId'];
$name = $_POST['name'];

$db = new database;

$location = $db->selectNow('files','location','id',$fileId);

$newLocation = str_replace($db->selectNow('files','name','id',$fileId),$name,$location);
rename($location,$newLocation.".".$db->selectNow('files','type','id',$fileId));
$db->editNow("files","id",$fileId,"location",$newLocation.".".$db->selectNow('files','type','id',$fileId));
$db->editNow("files","id",$fileId,"name",$name.".".$db->selectNow('files','type','id',$fileId));


?>
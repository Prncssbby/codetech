<?php
  require "../session/session.php";
  require "../vendor/autoload.php";
  use Codetech\database;

  $location = $_POST['location'];

  $db = new database;

  if(isset($_POST['folderId'])) {
    $folderId = $_POST['folderId'];
  } else {
    $folderId = 0;
  }



  if(!empty($_FILES['uploaded_file']))
  {
    $path = $location;
    $path = $path . basename( $_FILES['uploaded_file']['name']);
    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {

      $data = array(
          "ownerId" => $_SESSION['userId'],
          "name" => $_FILES['uploaded_file']['name'],
          "location" => $location.$_FILES['uploaded_file']['name'],
          "parent" => $_SESSION['currentPath'],
          "parentId" => $folderId,
          "type" => pathinfo($_FILES['uploaded_file']['name'],PATHINFO_EXTENSION),
          "dateAdded" => date('Y-m-d H:i:s'),
          "status" => "active"
        );

      $db->insertNow("files",$data);

      header("Location: ".$_POST['returnPage']);
      $_SESSION['uploadMessage'] = "The file ".  basename( $_FILES['uploaded_file']['name'])." has been uploaded";
      //"The file ".  basename( $_FILES['uploaded_file']['name'])." has been uploaded";
    } else{
        echo "There was an error uploading the file, please try again!";
    }
  }

<?php
 session_start();
 if( !isset($_SESSION['userId']) ) {
 	header("Location: ../views/accounts/login.php");
 }
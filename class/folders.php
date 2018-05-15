<?php 

namespace Codetech;

class folders {

	///database credentials
	public $host;
	public $username;
	public $password;
	public $database;
public function __construct() {
  $this->host = 'localhost';
  $this->username = 'root';
  $this->password = 'lovekylie';
  $this->database = 'codetech';
}

	private $getUserFolders_folders;

	public function getUserFolders_folders() {
		return $this->getUserFolders_folders;
	}

	public function getUserFolders($ownerId,$parentId,$orderBy) {
		$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
		$result = mysqli_query($connection, " SELECT id FROM folders WHERE ownerId = '$ownerId' AND status = 'active' and parentId = '$parentId' ORDER BY $orderBy ASC") or die("Query fail: " . mysqli_error()); 
		while($row = mysqli_fetch_array($result))
		{
			$this->getUserFolders_folders[] = $row['id'];
		}	
	}

}
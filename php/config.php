<?php
/*
  * Project Name: School Management System
  * File Name: Config.php
  * Description: Create Database connections
*/

	class config {
		
		private $host = "localhost";
		private $user = "root";
		private $password = "abc123"; //remember it acb123 || admin@123
		private $dbname = "maxwell";
		public	$DbCon;
		
		public function __construct() {
			$this->connect();
		}
		
		public function connect() {
			
			$db = new mysqli($this->host, $this->user, $this->password, $this->dbname);
			
			if(mysqli_connect_error()) {
				return false;
			}
			else {
				$this->DbCon = $db;
				return true;
			}
			
		}

	}
	
?>

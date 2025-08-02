<?php
class Database{
	
	//"localhost", "dbvwyqowhbpef1", "ugavgscekiiyl", "yzi5vge5cqzu"
	private $host  = 'localhost';
    private $user  = 'ugavgscekiiyl';
    private $password   = "yzi5vge5cqzu";
    private $database  = "dbvwyqowhbpef1"; 
    
    public function getConnection(){		
		$conn = new mysqli($this->host, $this->user, $this->password, $this->database);
		if($conn->connect_error){
			die("Error failed to connect to MySQL: " . $conn->connect_error);
		} else {
			return $conn;
		}
    }
}
?>
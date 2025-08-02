

<?php
class Archive_db{
	
	//"localhost", "dbvwyqowhbpef1", "ugavgscekiiyl", "yzi5vge5cqzu"
	private $host  = 'localhost';
    private $user  = 'u2folrqqrxzb7';
    private $password   = "ekblrgn2d00s";
    private $database  = "dbaoidz7wsoklo"; 
    
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


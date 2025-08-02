<?php
class Database{

	//"deavirtualdb.cpmacs668r4j.eu-central-1.rds.amazonaws.com", "erpdb", "erpuser", "q94@HiYi$33#"
	private $host  = 'deavirtualdb.cpmacs668r4j.eu-central-1.rds.amazonaws.com';
    private $user  = 'erpuser';
    private $password   = 'q94@HiYi$33#';
    private $database  = 'erpdb';

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

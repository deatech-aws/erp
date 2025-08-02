<?php
class Archive_db{

        //"deavirtualdb.cpmacs668r4j.eu-central-1.rds.amazonaws.com", "archive_db", "archiveuser", "8Wn$Ln7[kel#"
        private $host  = 'deavirtualdb.cpmacs668r4j.eu-central-1.rds.amazonaws.com';
    private $user  = 'archiveuser';
    private $password   = '8Wn$Ln7[kel#';
    private $database  = 'archive_db';

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

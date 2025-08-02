<?php
date_default_timezone_set('Africa/Lagos');

$host     = "localhost";//Ip of database, in this case my host machine
$user     = "root";	//Username to use
$pass     = "noun@dea";//Password for that user
$dbname   = "erp";//Name of the database


try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo_attr = array(PDO::ATTR_CURSOR =>PDO::CURSOR_FWDONLY);
}catch(PDOException $e)
{
  echo $e->getMessage();
}

?>

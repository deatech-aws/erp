<?php
date_default_timezone_set('Africa/Lagos');
$host = "samjedu.com";
$databasename= "samjedu_nounexam";
$username = "samjedu_sysadmin";
$password = "password2016";


$dsn = 'mysql:dbname=exam_rpt;host=127.0.0.1';
$user = 'root';
$password = '';

$host     = "localhost";//Ip of database, in this case my host machine
$user     = "ugavgscekiiyl";	//Username to use
$pass     = "yzi5vge5cqzu";//Password for that user
$dbname   = "dbvwyqowhbpef1";//Name of the database


try {
   $tcon = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $tcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// $pdo_attr = array(PDO::ATTR_CURSOR =>PDO::CURSOR_FWDONLY);
    // $tcon = new PDO($dsn, $user, $password,array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    // PDO::ATTR_EMULATE_PREPARES => false));
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>

<?php
session_start();
$config = "pdo_connectdb.php";
require $config;
	$query="SELECT *
    FROM acad_sess";
    $stmt=$conn->prepare($query,$pdo_attr);
    $stmt->execute();
    while ($rw=$stmt->fetch(PDO::FETCH_BOTH,PDO::FETCH_ORI_NEXT)){
      $_SESSION['sess']=$rw[0];
    }
	$stmt->closeCursor();
?>

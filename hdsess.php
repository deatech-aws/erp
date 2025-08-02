<?php
session_start();
include("encr_decr_api.php");
$_SESSION['location']="hd_sor";

// $url = $_REQUEST['url'];
$url = enc($_REQUEST['url']);
$_SESSION['Returnurl']=$url;
//$_SESSION['Returnurl1']=$url1;
header('location:'.$_SESSION['location']);
?>

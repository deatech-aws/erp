<?php
session_start();
include("encr_decr.php");
$_SESSION['location']="fac_dashboard";

$url = enc($_REQUEST['Returnurl']);
//$url1 = enc($_REQUEST['Returnurl1']);
$_SESSION['fac_id']=$url;
//$_SESSION['Returnurl1']=$url1;
header('location:'.$_SESSION['location']);
?>

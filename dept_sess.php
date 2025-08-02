<?php
session_start();
include("encr_decr.php");
$_SESSION['location']="dept_dashboard";

$url = enc($_REQUEST['Returnurl']);
//$url1 = enc($_REQUEST['Returnurl1']);
$_SESSION['dept_id']=$url;
header('location:'.$_SESSION['location']);
?>

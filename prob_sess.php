<?php
session_start();
include("encr_decr.php");
$_SESSION['location']="prob_comprehensive";

$url = enc($_REQUEST['Returnurl']);
//$url1 = enc($_REQUEST['Returnurl1']);
$str=explode('|',$url);
$_SESSION['prob_id']=$str[0];
$_SESSION['lev_id']=$str[1];
header('location:'.$_SESSION['location']);
?>

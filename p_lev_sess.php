<?php
session_start();
include("encr_decr.php");
$_SESSION['location']="prog_resultsheet";

$url = enc($_REQUEST['Returnurl']);
//$url1 = enc($_REQUEST['Returnurl1']);
$str=explode('|',$url);
$_SESSION['prog_id']=$str[0];
$_SESSION['lev_id']=$str[1];
//$_SESSION['Returnurl1']=$url1;
header('location:'.$_SESSION['location']);
?>

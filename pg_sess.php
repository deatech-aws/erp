<?php
session_start();
include("encr_decr.php");
 
$_SESSION['location']="spg_dash";

$url = enc($_REQUEST['Returnurl']);
//$url1 = enc($_REQUEST['Returnurl1']);
if ($url =="PGX"){
  $_SESSION['educat']='PGY';
  $_SESSION['dsc'] ="Switch To PGD";
}else{
  $_SESSION['educat']='PGX';
  $_SESSION['dsc'] ="Switch To Masters";
}

// $_SESSION['lev_id']=$str[1];
header('location:'.$_SESSION['location']);
?>

<?php
// session_start();
include "../inc/pdo_connectdb.php";
include '../inc/ajax_get_session.php';
// $configfile = "../inc/pdo_trans_connectdb.php";
$ddate = date("Y-m-d");
// require $configfile;
$_SESSION['dsc'] ="Switch To Masters";
$_SESSION['email']="";
$t_usr="";
$t_pwd="";
$_SESSION['usrid']= "";
$_SESSION['fac_id']= "";
$_SESSION['u_cat'] ="";

$t_usr = $_POST['id_usr1'];
$t_pwd = $_POST['id_pwd1'];
$_SESSION['email']=$t_usr;
$query ="SELECT employeeid,CONCAT(Title,' ',lname,' ',fname) as vname, cfacultyid
		FROM employees
		WHERE emailid =:username AND passwords=:password";
$pwd= md5($t_pwd);

$query ="SELECT employeeid,CONCAT(Title,' ',lname) as vname, cUnitId,u_cat
		FROM employees
		WHERE emailid ='$t_usr' AND passwords='$pwd'";

$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

$stmt->execute();
if ($stmt->rowCount()<=0){
	$stmt->closeCursor();
	echo "0";
	exit;
}
$_SESSION['email']=$t_usr;
while ($rw = $stmt->fetch(PDO::FETCH_BOTH, PDO::FETCH_ORI_NEXT))
{
	$data="";
  $_SESSION['usrid']= $rw[0];
  $_SESSION['name'] = $rw[1];
  $_SESSION['fac_id']= $rw[2];
  $_SESSION['u_cat'] = $rw[3];

	if($_SESSION['u_cat']=="MNGT"){
		$data="3";
	}elseif($_SESSION['u_cat']=="CTRU"){
		$data="2";
	}else{
		$data="1";
	}
	switch ($_SESSION['u_cat']) {
		case 'MGMT':
		case 'DEAT':
			$data="1";
			break;
		case 'DEAN':
			$data="2";
			break;
	case 'FHOD';
	case 'FAEO':
	  $data="3";
			break;
	case 'FPCT':
		$data="4";
			break;
	case 'CCON':
	case 'ICTO':
	case 'CTRU':
	$data="5";
		break;
	case 'SPGS':
	$data="6";
	break;
case 'HPDK':
	$data="7";
	break;

	}
	//ICTO

}
echo $data;
$stmt->closeCursor();
 ?>

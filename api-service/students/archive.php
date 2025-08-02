<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include_once '../config/Archive_db.php';
include_once '../class/Students.php';

$database = new Archive_db();
$db = $database->getConnection();
 
$students = new Students($db);

$students->id = (isset($_GET['id']) && $_GET['id']) ? $_GET['id'] : '0';

$result = $students->read_archive();

if($result->num_rows > 0){    
    $studentRecords=array();
    $studentRecords["students"]=array(); 
	while ($item = $result->fetch_assoc()) { 	
        extract($item); 
     
        $itemDetails=array(
            "id" => $id,
            "name" => $vname,			
			"faculty" => $faculty,
            "program" => $program,
            "specialization"=> $specialization,
            "dob" => $dob,
            "sex" => $sex,
            "eduCtg" => $eduCtg,
			"cfacultyid" => $cfacultyid,
            "tcc" => $tcc,
            "tce" => $tce,
            "wgp" => $wgp,
            "cgpa" => $cgpa,
             "vyear" => $vyear,
             "cstudycentreid"=>$cstudycentreid,
             "studycentre"=>$studycentre,              
            "cprogrammeid"=>$cprogrammeid
        ); 
       array_push($studentRecords["students"], $itemDetails);
    }    
    http_response_code(200);     
    echo json_encode($studentRecords);
}else{     
    // http_response_code(404);     
    // echo json_encode(
    //     array("message" => "No student found.")
    // );
	echo 0;
} 
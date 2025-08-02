<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Archive_db.php';
include_once '../class/Students.php';
$database = new Archive_db();
$db = $database->getConnection();
 
$students = new Students($db);

$students->id = (isset($_GET['id']) && $_GET['id']) ? $_GET['id'] : '0';
//echo $students->id;
$results = $students->result();
if($results->num_rows > 0){    
    $studentResults=array();
    $studentResults["results"]=array(); 
	while ($item = $results->fetch_assoc()) { 	
        extract($item);      
        $resultDetails=array(           
            "code" => $code,			
			"title" => $title,
            "unit" => $unit,            
            "grade" => $grade,
            "remark" => $remark,
            "level" => $level
        ); 
       array_push($studentResults["results"], $resultDetails);
    }    
    http_response_code(200);     
    echo json_encode($studentResults);
}else{     
    http_response_code(404);     
    echo json_encode(
        array("message" => "No student result found.")
    );
} 
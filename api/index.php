<?php
declare(strict_types=1);

spl_autoload_register(function ($class) {
    require __DIR__ . "/src/$class.php";
});


//Make sure that the content type of the POST request has been set to application/json
$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
if(strcasecmp($contentType, 'application/json') != 0){
    throw new Exception('Content type must be: application/json');
}

//Receive the RAW post data.
$content = trim(file_get_contents("php://input"));

//Attempt to decode the incoming RAW post data from JSON.
$decoded = json_decode($content, true);

//If json_decode failed, the JSON is invalid.
if(!is_array($decoded)){
    throw new Exception('Received content contained invalid JSON!');
}
//Process the JSON.

$method = $_SERVER['REQUEST_METHOD'];
$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
var_dum(json_encode($request));
exit;
switch ($method) {
  case 'PUT':
   // do_something_with_put($request);  
    break;
  case 'POST':
    //do_something_with_post($request);  
    break;
  case 'GET':
    $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
    if(strcasecmp($contentType, 'application/json') != 0){
        throw new Exception('Content type must be: application/json');

    } 
    // if ($request[0] == "api") {
        $id = "NOU090164110" ;//$request[1] ?? null;
        $database = new Database("localhost", "dbvwyqowhbpef1", "ugavgscekiiyl", "yzi5vge5cqzu");

        $gateway = new AppGateway($database);

        $controller = new AppController($gateway);

        $controller->processRequest($_SERVER["REQUEST_METHOD"],$id);

    // }
    break;
  default:
    //handle_error($request);  
    break;
}
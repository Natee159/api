<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate product object
include_once '../objects/product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if (
   
    !empty($data->Date) &&
    !empty($data->Time) &&
    !empty($data->Total) &&
    !empty($data->Amount) &&
    !empty($data->Shipment) &&
    !empty($data->Status) &&
    !empty($data->Customer_id) 
) {

    // set product property values
   
    $product->Date = $data->Date;
    $product->Time = $data->Time;
    $product->Total = $data->Total;
    $product->Amount = $data->Amount;
    $product->Shipment = $data->Shipment;
    $product->Status = $data->Status;
    $product->Customer_id = $data->Customer_id;    
    
    // create the product
    if ($product->insertorder()) {

        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "Product was created."));
    }

    // if unable to create the product, tell the user
    else {

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to create product."));
    }
}

// tell the user data is incomplete
else {

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
}

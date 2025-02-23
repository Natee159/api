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
   
    !empty($data->Firstname) &&
    !empty($data->Lastname) &&
    !empty($data->Gender) &&
    !empty($data->Date_birth) &&
    !empty($data->Phone_num) &&
    !empty($data->Address) &&
    !empty($data->Email) &&
    !empty($data->Password) 
) {

    // set product property values
   
    $product->Firstname = $data->Firstname;
    $product->Lastname = $data->Lastname;
    $product->Gender = $data->Gender;
    $product->Date_birth = $data->Date_birth;
    $product->Phone_num = $data->Phone_num;
    $product->Address = $data->Address;
    $product->Email = $data->Email;
    $product->Password = $data->Password;
    // create the product
    if ($product->register()) {

        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "Register was created."));
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

<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/product.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$product = new Product($db);
  
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
  
// set ID property of product to be edited
$product->Customer_id=isset($_GET["Customer_id"]) ? $_GET["Customer_id"] : die();
  
// set product property values
$product->Firstname = $data->Firstname;
$product->Lastname = $data->Lastname;
$product->Gender = $data->Gender;
$product->Date_birth = $data->Date_birth;
$product->Phone_num = $data->Phone_num;
$product->Address = $data->Address;
$product->Email = $data->Email;
$product->Password = $data->Password;
  
// update the product
if($product->updatedata()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "Product was updated."));
}
  
// if unable to update the product, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update product."));
}
?>
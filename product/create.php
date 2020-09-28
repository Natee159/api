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
   
    !empty($data->Product_name) &&
    !empty($data->Author_name) &&
    !empty($data->Publi_name) &&
    !empty($data->Detail) &&
    !empty($data->Image) &&
    !empty($data->Total) &&
    !empty($data->Price) &&
    !empty($data->Order_Num) &&
    !empty($data->Category_ID) &&
    !empty($data->Promotion_id)
    
) {

    // set product property values
   
    $product->Product_name = $data->Product_name;
    $product->Author_name = $data->Author_name;
    $product->Publi_name = $data->Publi_name;
    $product->Detail = $data->Detail;
    $product->Image = $data->Image;
    $product->Total = $data->Total;
    $product->Price = $data->Price;
    $product->Order_Num = $data->Order_Num;
    $product->Category_ID = $data->Category_ID;
    $product->Promotion_id = $data->Promotion_id;
    

    // create the product
    if ($product->create()) {

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

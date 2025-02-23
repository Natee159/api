<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../../config/database.php';
include_once '../../objects/product.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$product = new Product($db);

// set ID property of record to read
$product->Product_ID = isset($_GET['Product_ID']) ? $_GET['Product_ID'] : die();

// query products
$stmt = $product->Detail();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $products_arr=array();
    $products_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $product_item=array(
            "Product_id" => $Product_ID,
            "Product_name" => $Product_name,
            "Author_name" => $Author_name,
            "Publi_name" => $Publi_name,
            "Detail" => $Detail,
            "Image" => $Image,
            "Total" => $Total,
            "Price" => $Price,
            "Order_Num" => $Order_Num,
            "Category_ID" => $Category_ID,
            "Promotion_id" => $Promotion_id
        );
  
        array_push($products_arr["records"], $product_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($products_arr);
}
  
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
    );
}
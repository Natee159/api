<?php
class Product{
  
    // database connection and table name
    private $conn;
    private $table_name = "product";
  
    // object properties
    
    // public $Product_id;
    public $Product_name;
    public $Author_name;
    public $Publi_name;
    public $Detail;
    public $Image;
    public $Total;
    public $Price;
    public $Order_Num;
    public $Category_ID;
    public $Promotion_id;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

// read products
function read(){
  
    // select all query
    $query = " SELECT * FROM `product` ";

    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // execute query
    $stmt->execute();
  
    return $stmt;
}
function show(){
  
    // select all query
    $query = " SELECT * FROM `product` LIMIT 4 ";
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // execute query
    $stmt->execute();
  
    return $stmt;
}
function Detail(){
  
    // select all query
    $query = " SELECT * FROM `product` WHERE Product_iD = '" . $this->Product_id . "' ";
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // execute query
    $stmt->execute();
  
    return $stmt;
}

function Login(){
  
    // select all query
    $query = " SELECT * FROM `customer` WHERE Email = '" . $this->Email . "', Password = '" . $this->Password . "' ";
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // execute query
    $stmt->execute();
  
    return $stmt;
}


// create product
function create(){
  
    // query to insert record
    $query = "INSERT INTO
                `product`
            SET
            Product_name=:Product_name, Author_name=:Author_name, Publi_name=:Publi_name, Detail=:Detail, Image=:Image,Total=:Total,Price=:Price,Order_Num=:Order_Num,Category_ID=:Category_ID,Promotion_id=:Promotion_id";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    // $this->Product_id=htmlspecialchars(strip_tags($this->Product_id));
    $this->Product_name=htmlspecialchars(strip_tags($this->Product_name));
    $this->Author_name=htmlspecialchars(strip_tags($this->Author_name));
    $this->Publi_name=htmlspecialchars(strip_tags($this->Publi_name));
    $this->Detail=htmlspecialchars(strip_tags($this->Detail));
    $this->Image=htmlspecialchars(strip_tags($this->Image));
    $this->Total=htmlspecialchars(strip_tags($this->Total));
    $this->Price=htmlspecialchars(strip_tags($this->Price));
    $this->Order_Num=htmlspecialchars(strip_tags($this->Order_Num));
    $this->Category_ID=htmlspecialchars(strip_tags($this->Category_ID));
    $this->Promotion_id=htmlspecialchars(strip_tags($this->Promotion_id));
    
  
    // bind values
    // $stmt->bindParam(":Product_id", $this->Product_id);
    $stmt->bindParam(":Product_name", $this->Product_name);
    $stmt->bindParam(":Author_name", $this->Author_name);
    $stmt->bindParam(":Publi_name", $this->Publi_name);
    $stmt->bindParam(":Detail", $this->Detail);
    $stmt->bindParam(":Image", $this->Image);
    $stmt->bindParam(":Total", $this->Total);
    $stmt->bindParam(":Price", $this->Price);
    $stmt->bindParam(":Order_Num", $this->Order_Num);
    $stmt->bindParam(":Category_ID", $this->Category_ID);
    $stmt->bindParam(":Promotion_id", $this->Promotion_id);
    
    
  
    // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false; 
}

function register(){
  
    // query to insert record
    $query = "INSERT INTO
                `customer`
            SET
            Firstname=:Firstname, Lastname=:Lastname, Gender=:Gender, Date_birth=:Date_birth, Phone_num=:Phone_num,Address=:Address,Email=:Email,Password=:Password";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    // $this->Product_id=htmlspecialchars(strip_tags($this->Product_id));
    $this->Firstname=htmlspecialchars(strip_tags($this->Firstname));
    $this->Lastname=htmlspecialchars(strip_tags($this->Lastname));
    $this->Gender=htmlspecialchars(strip_tags($this->Gender));
    $this->Date_birth=htmlspecialchars(strip_tags($this->Date_birth));
    $this->Phone_num=htmlspecialchars(strip_tags($this->Phone_num));
    $this->Address=htmlspecialchars(strip_tags($this->Address));
    $this->Email=htmlspecialchars(strip_tags($this->Email));
    $this->Password=htmlspecialchars(strip_tags($this->Password));

    // bind values
    // $stmt->bindParam(":Product_id", $this->Product_id);
    $stmt->bindParam(":Firstname", $this->Firstname);
    $stmt->bindParam(":Lastname", $this->Lastname);
    $stmt->bindParam(":Gender", $this->Gender);
    $stmt->bindParam(":Date_birth", $this->Date_birth);
    $stmt->bindParam(":Phone_num", $this->Phone_num);
    $stmt->bindParam(":Address", $this->Address);
    $stmt->bindParam(":Email", $this->Email);
    $stmt->bindParam(":Password", $this->Password);
  
    // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false; 
}

// delete the product
function delete(){
  
    // delete query
    $query = "DELETE FROM `product` WHERE Product_id = ?";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->Product_id=htmlspecialchars(strip_tags($this->Product_id));
  
    // bind id of record to delete
    $stmt->bindParam(1, $this->Product_id);
  
    // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false;
}

// update the product
function update(){
  
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                Product_name = :Product_name,
                Author_name = :Author_name,
                Publi_name = :Publi_name,
                Detail = :Detail,
                Image = :Image,
                Total = :Total,
                Price = :Price,
                Order_Num = :Order_Num,
                Category_ID = :Category_ID,
                Promotion_id = :Promotion_id
            WHERE
                Product_id = :Product_id";
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->Product_name=htmlspecialchars(strip_tags($this->Product_name));
    $this->Author_name=htmlspecialchars(strip_tags($this->Author_name));
    $this->Publi_name=htmlspecialchars(strip_tags($this->Publi_name));
    $this->Detail=htmlspecialchars(strip_tags($this->Detail));
    $this->Image=htmlspecialchars(strip_tags($this->Image));
    $this->Total=htmlspecialchars(strip_tags($this->Total));
    $this->Price=htmlspecialchars(strip_tags($this->Price));
    $this->Order_Num=htmlspecialchars(strip_tags($this->Order_Num));
    $this->Category_ID=htmlspecialchars(strip_tags($this->Category_ID));
    $this->Promotion_id=htmlspecialchars(strip_tags($this->Promotion_id));

    $this->Product_id=htmlspecialchars(strip_tags($this->Product_id));
  
    // bind new values
    $stmt->bindParam(':Product_name', $this->Product_name);
    $stmt->bindParam(':Author_name', $this->Author_name);
    $stmt->bindParam(':Publi_name', $this->Publi_name);
    $stmt->bindParam(':Detail', $this->Detail);
    $stmt->bindParam(':Image', $this->Image);
    $stmt->bindParam(':Total', $this->Total);
    $stmt->bindParam(':Price', $this->Price);
    $stmt->bindParam(':Order_Num', $this->Order_Num);
    $stmt->bindParam(':Category_ID', $this->Category_ID);
    $stmt->bindParam(':Promotion_id', $this->Promotion_id);

    $stmt->bindParam(':Product_id', $this->Product_id);
  
    // execute the query
    if($stmt->execute()){
        return true;
    }
  
    return false;
}

}
?>
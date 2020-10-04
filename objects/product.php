<?php
class Product
{

    // database connection and table name
    private $conn;
    private $table_name = "product";

    // object properties

    public $Product_id;
    public $Product_name;
    public $Author_name;
    public $Publi_name;
    public $Detail;
    public $Image;
    public $Total;
    public $Price;
    public $Category_ID;
    public $Amount;
    public $Status;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read products
    function read()
    {

        // select all query
        $query = " SELECT * FROM `product` ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
    function readorder()
    {

        // select all query
        $query = " SELECT * FROM `order`  ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
    function readcategory()
    {

        // select all query
        $query = " SELECT * FROM `category` ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
    function readcomment()
    {

        // select all query
        $query = " SELECT * FROM `comment` ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
    function readcustomer()
    {

        // select all query
        $query = " SELECT * FROM `customer` ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function readpromotion()
    {

        // select all query
        $query = " SELECT * FROM `promotion` ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function readtype()
    {

        // select all query
        $query = " SELECT * FROM `type` ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function readpurchase()
    {

        // select all query
        $query = " SELECT purchase_product.Product_id, 
        purchase_product.Product_name, 
        purchase_product.Price, 
        `order`.Amount, 
        `order`.Total,
        CASE WHEN purchase_product.Total > 0 THEN 'มีสินค้า' ELSE 'ไม่มีสินค้า' END AS 'Status'
        FROM
    (
        SELECT purchase.Order_Num,product.* 
        FROM purchase
        INNER JOIN product
        ON purchase.Product_id = product.Product_id
    ) purchase_product
            INNER JOIN `order`
            ON purchase_product.Order_Num = `order`.Order_Num ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function show()
    {

        // select all query
        $query = " SELECT * FROM `product` LIMIT 4 ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
    function Detail()
    {

        // select all query
        $query = " SELECT * FROM `product` WHERE Product_id = '" . $this->Product_id . "' ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function login()
    {

        // select one query
        $query = " SELECT * FROM `customer` WHERE Email = '" . $this->Email . "' AND Password = '" . $this->Password . "' ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function search($keywords)
    {

        // select all query
        $query = "SELECT * FROM  `product`  WHERE  Product_name LIKE '%" . $keywords . "%' ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $keywords = htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        // bind
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function searchauthor($keywords)
    {

        // select all query
        $query = "SELECT * FROM  `product`  WHERE  Author_name LIKE '%" . $keywords . "%' ";
 
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $keywords = htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        // bind
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // create product
    function create()
    {

        // query to insert record
        $query = "INSERT INTO
                `product`
            SET
            Product_name=:Product_name, Author_name=:Author_name, Publi_name=:Publi_name, Detail=:Detail, Image=:Image,Total=:Total,Price=:Price,Category_ID=:Category_ID,Promotion_id=:Promotion_id";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        // $this->Product_id=htmlspecialchars(strip_tags($this->Product_id));
        $this->Product_name = htmlspecialchars(strip_tags($this->Product_name));
        $this->Author_name = htmlspecialchars(strip_tags($this->Author_name));
        $this->Publi_name = htmlspecialchars(strip_tags($this->Publi_name));
        $this->Detail = htmlspecialchars(strip_tags($this->Detail));
        $this->Image = htmlspecialchars(strip_tags($this->Image));
        $this->Total = htmlspecialchars(strip_tags($this->Total));
        $this->Price = htmlspecialchars(strip_tags($this->Price));
        $this->Category_ID = htmlspecialchars(strip_tags($this->Category_ID));
        $this->Promotion_id = htmlspecialchars(strip_tags($this->Promotion_id));


        // bind values
        // $stmt->bindParam(":Product_id", $this->Product_id);
        $stmt->bindParam(":Product_name", $this->Product_name);
        $stmt->bindParam(":Author_name", $this->Author_name);
        $stmt->bindParam(":Publi_name", $this->Publi_name);
        $stmt->bindParam(":Detail", $this->Detail);
        $stmt->bindParam(":Image", $this->Image);
        $stmt->bindParam(":Total", $this->Total);
        $stmt->bindParam(":Price", $this->Price);
        $stmt->bindParam(":Category_ID", $this->Category_ID);
        $stmt->bindParam(":Promotion_id", $this->Promotion_id);



        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    function insertorder()
    {

        // query to insert record
        $query = "INSERT INTO
                `order`
            SET
            Date=:Date, Time=:Time, Total=:Total, Amount=:Amount, Shipment=:Shipment,Status=:Status";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        // $this->Product_id=htmlspecialchars(strip_tags($this->Product_id));
        $this->Date = htmlspecialchars(strip_tags($this->Date));
        $this->Time = htmlspecialchars(strip_tags($this->Time));
        $this->Total = htmlspecialchars(strip_tags($this->Total));
        $this->Amount = htmlspecialchars(strip_tags($this->Amount));
        $this->Shipment = htmlspecialchars(strip_tags($this->Shipment));
        $this->Status = htmlspecialchars(strip_tags($this->Status));

        // bind values
        // $stmt->bindParam(":Product_id", $this->Product_id);
        $stmt->bindParam(":Date", $this->Date);
        $stmt->bindParam(":Time", $this->Time);
        $stmt->bindParam(":Total", $this->Total);
        $stmt->bindParam(":Amount", $this->Amount);
        $stmt->bindParam(":Shipment", $this->Shipment);
        $stmt->bindParam(":Status", $this->Status);


        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function insertcategory()
    {

        // query to insert record
        $query = "INSERT INTO
                `category`
            SET
            Category_Name=:Category_Name,Type_ID=:Type_ID";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        // $this->Product_id=htmlspecialchars(strip_tags($this->Product_id));
        $this->Category_Name = htmlspecialchars(strip_tags($this->Category_Name));
        $this->Type_ID = htmlspecialchars(strip_tags($this->Type_ID));

        // bind values
        // $stmt->bindParam(":Product_id", $this->Product_id);
        $stmt->bindParam(":Category_Name", $this->Category_Name);
        $stmt->bindParam(":Type_ID", $this->Type_ID);
        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function insertcomment()
    {

        // query to insert record
        $query = "INSERT INTO
                `comment`
            SET
            Score=:Score, Date=:Date, Comment=:Comment, Customer_id=:Customer_id, Product_id=:Product_id";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        // $this->Product_id=htmlspecialchars(strip_tags($this->Product_id));
        $this->Score = htmlspecialchars(strip_tags($this->Score));
        $this->Date = htmlspecialchars(strip_tags($this->Date));
        $this->Comment = htmlspecialchars(strip_tags($this->Comment));
        $this->Customer_id = htmlspecialchars(strip_tags($this->Customer_id));
        $this->Product_id = htmlspecialchars(strip_tags($this->Product_id));

        // bind values
        // $stmt->bindParam(":Product_id", $this->Product_id);
        $stmt->bindParam(":Score", $this->Score);
        $stmt->bindParam(":Date", $this->Date);
        $stmt->bindParam(":Comment", $this->Comment);
        $stmt->bindParam(":Customer_id", $this->Customer_id);
        $stmt->bindParam(":Product_id", $this->Product_id);


        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function insertpromotion()
    {

        // query to insert record
        $query = "INSERT INTO
                `promotion`
            SET
            Promotion_Name=:Promotion_Name, Percent=:Percent, StartDate=:StartDate, EndDate=:EndDate";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        // $this->Product_id=htmlspecialchars(strip_tags($this->Product_id));
        $this->Promotion_Name = htmlspecialchars(strip_tags($this->Promotion_Name));
        $this->Percent = htmlspecialchars(strip_tags($this->Percent));
        $this->StartDate = htmlspecialchars(strip_tags($this->StartDate));
        $this->EndDate = htmlspecialchars(strip_tags($this->EndDate));


        // bind values
        // $stmt->bindParam(":Product_id", $this->Product_id);
        $stmt->bindParam(":Promotion_Name", $this->Promotion_Name);
        $stmt->bindParam(":Percent", $this->Percent);
        $stmt->bindParam(":StartDate", $this->StartDate);
        $stmt->bindParam(":EndDate", $this->EndDate);



        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function insertpurchase()
    {

        // query to insert record
        $query = "INSERT INTO
                `purchase`
            SET
            Product_id=:Product_id, Order_Num=:Order_Num";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        // $this->Product_id=htmlspecialchars(strip_tags($this->Product_id));
        $this->Product_id = htmlspecialchars(strip_tags($this->Product_id));
        $this->Order_Num = htmlspecialchars(strip_tags($this->Order_Num));


        // bind values
        // $stmt->bindParam(":Product_id", $this->Product_id);
        $stmt->bindParam(":Product_id", $this->Product_id);
        $stmt->bindParam(":Order_Num", $this->Order_Num);




        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function inserttype()
    {

        // query to insert record
        $query = "INSERT INTO
                `type`
            SET
            Type_Name=:Type_Name";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        // $this->Product_id=htmlspecialchars(strip_tags($this->Product_id));
        $this->Type_Name = htmlspecialchars(strip_tags($this->Type_Name));


        // bind values
        // $stmt->bindParam(":Product_id", $this->Product_id);
        $stmt->bindParam(":Type_Name", $this->Type_Name);




        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function register()
    {

        // query to insert record
        $query = "INSERT INTO
                `customer`
            SET
            Firstname=:Firstname, Lastname=:Lastname, Gender=:Gender, Date_birth=:Date_birth, Phone_num=:Phone_num,Address=:Address,Email=:Email,Password=:Password";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        // $this->Product_id=htmlspecialchars(strip_tags($this->Product_id));
        $this->Firstname = htmlspecialchars(strip_tags($this->Firstname));
        $this->Lastname = htmlspecialchars(strip_tags($this->Lastname));
        $this->Gender = htmlspecialchars(strip_tags($this->Gender));
        $this->Date_birth = htmlspecialchars(strip_tags($this->Date_birth));
        $this->Phone_num = htmlspecialchars(strip_tags($this->Phone_num));
        $this->Address = htmlspecialchars(strip_tags($this->Address));
        $this->Email = htmlspecialchars(strip_tags($this->Email));
        $this->Password = htmlspecialchars(strip_tags($this->Password));

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
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // delete the product
    function delete()
    {

        // delete query
        $query = "DELETE FROM `product` WHERE Product_id = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->Product_id = htmlspecialchars(strip_tags($this->Product_id));

        // bind id of record to delete
        $stmt->bindParam(1, $this->Product_id);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function deleteorder()
    {

        // delete query
        $query = "DELETE FROM `order` WHERE Order_Num = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->Order_Num = htmlspecialchars(strip_tags($this->Order_Num));

        // bind id of record to delete
        $stmt->bindParam(1, $this->Order_Num);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function deletecategory()
    {

        // delete query
        $query = "DELETE FROM `category` WHERE Category_ID = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->Category_ID = htmlspecialchars(strip_tags($this->Category_ID));

        // bind id of record to delete
        $stmt->bindParam(1, $this->Category_ID);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function deletecomment()
    {

        // delete query
        $query = "DELETE FROM `comment` WHERE Comment_ID = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->Comment_ID = htmlspecialchars(strip_tags($this->Comment_ID));

        // bind id of record to delete
        $stmt->bindParam(1, $this->Comment_ID);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function deletepromotion()
    {

        // delete query
        $query = "DELETE FROM `promotion` WHERE Promotion_id  = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->Promotion_id = htmlspecialchars(strip_tags($this->Promotion_id));

        // bind id of record to delete
        $stmt->bindParam(1, $this->Promotion_id);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function deletetype()
    {

        // delete query
        $query = "DELETE FROM `type` WHERE Type_ID  = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->Type_ID = htmlspecialchars(strip_tags($this->Type_ID));

        // bind id of record to delete
        $stmt->bindParam(1, $this->Type_ID);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // update the product
    function update()
    {

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
                Category_ID = :Category_ID,
                Promotion_id = :Promotion_id
            WHERE
                Product_id = :Product_id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->Product_name = htmlspecialchars(strip_tags($this->Product_name));
        $this->Author_name = htmlspecialchars(strip_tags($this->Author_name));
        $this->Publi_name = htmlspecialchars(strip_tags($this->Publi_name));
        $this->Detail = htmlspecialchars(strip_tags($this->Detail));
        $this->Image = htmlspecialchars(strip_tags($this->Image));
        $this->Total = htmlspecialchars(strip_tags($this->Total));
        $this->Price = htmlspecialchars(strip_tags($this->Price));
        $this->Category_ID = htmlspecialchars(strip_tags($this->Category_ID));
        $this->Promotion_id = htmlspecialchars(strip_tags($this->Promotion_id));

        $this->Product_id = htmlspecialchars(strip_tags($this->Product_id));

        // bind new values
        $stmt->bindParam(':Product_name', $this->Product_name);
        $stmt->bindParam(':Author_name', $this->Author_name);
        $stmt->bindParam(':Publi_name', $this->Publi_name);
        $stmt->bindParam(':Detail', $this->Detail);
        $stmt->bindParam(':Image', $this->Image);
        $stmt->bindParam(':Total', $this->Total);
        $stmt->bindParam(':Price', $this->Price);
        $stmt->bindParam(':Category_ID', $this->Category_ID);
        $stmt->bindParam(':Promotion_id', $this->Promotion_id);

        $stmt->bindParam(':Product_id', $this->Product_id);

        // execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}

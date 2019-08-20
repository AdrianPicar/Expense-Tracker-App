<?php

class Entry{
    private $conn;
    private $table_name = "entries";

    private $username;
    public $amount;
    public $category;
    public $remarks;

    function __construct($db){
        $this->conn = $db;
        $this->username = $_SESSION["username"];
    }

    function add_entry(){
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                username=:username, date_created=:date, amount=:amount, category=:category, remarks=:remarks";  

        $stmt = $this->conn->prepare($query);
        
        $this->amount=htmlspecialchars(strip_tags($this->amount));
        $this->category=htmlspecialchars(strip_tags($this->category));
        $this->remarks=htmlspecialchars(strip_tags($this->remarks));
        
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":amount", $this->amount);
        $stmt->bindParam(":category", $this->category);
        $stmt->bindParam(":remarks", $this->remarks);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        } 
    }

    function read_all_entries(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE username=:username ORDER BY date_created DESC LIMIT 10";  

        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":username", $this->username);
        $stmt->execute();

        return $stmt;
    }
}

function create(){
 
    //write query
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                name=:name, price=:price, description=:description, category_id=:category_id, created=:created";

    $stmt = $this->conn->prepare($query);

    // posted values
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->price=htmlspecialchars(strip_tags($this->price));
    $this->description=htmlspecialchars(strip_tags($this->description));
    $this->category_id=htmlspecialchars(strip_tags($this->category_id));

    // to get time-stamp for 'created' field
    $this->timestamp = date('Y-m-d H:i:s');

    // bind values 
    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":price", $this->price);
    $stmt->bindParam(":description", $this->description);
    $stmt->bindParam(":category_id", $this->category_id);
    $stmt->bindParam(":created", $this->timestamp);

    if($stmt->execute()){
        return true;
    }else{
        return false;
    }

}

?>
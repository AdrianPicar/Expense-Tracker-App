<?php

class User{
    private $conn;
    private $table_name = "users";

    public $username;
    public $password;

    private $amount_budget;

    function __construct($db){
        $this->conn = $db;
    }

    function check_user(){
        $query = "SELECT password FROM " . $this->table_name . " WHERE username = :username";  

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $this->username);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($stmt->rowCount() == 0)
            return "0";
        else{
            if($this->password == $row['password']){
                $_SESSION["username"] = $this->username;
                return $this->username;
            }
            else
                return "0";
        }        
    }

    function get_user_info(){
        $query = "SELECT SUM(amount) AS total FROM entries WHERE username = :username";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $this->username);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($stmt->rowCount() == 0)
            return "0";
        else{
            $this->amount_budget = $row['total'];

            return $this->amount_budget;
        }        
    }
}

/* class Category{
 
    // database connection and table name
    private $conn;
    private $table_name = "categories";
 
    // object properties
    public $id;
    public $name;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used by select drop-down list
    function read(){
        //select all data
        $query = "SELECT
                    id, name
                FROM
                    " . $this->table_name . "
                ORDER BY
                    name";  
 
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }
	
	// used to read category name by its ID
	function readName(){
		
		$query = "SELECT name FROM " . $this->table_name . " WHERE id = ? limit 0,1";
	
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
	
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->name = $row['name'];
	}
} */

?>
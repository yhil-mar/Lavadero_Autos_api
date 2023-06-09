<?php

// require_once 'database.php';

// use Database;

class ProductsTable {
    
    protected $connection;
    
    public function __construct() {
        $database = new \Database();
        $this->connection = $database->getConnection();
    }

    public function createProducts () {
        
        $query = "CREATE TABLE IF NOT EXISTS products (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            nameProduct VARCHAR(30) ,    
            stock INT(10) NOT NULL, 
            unit VARCHAR(50) NOT NULL
        )";
        
        $this->connection->query($query);
        
        }
    }

$productsTable = new ProductsTable();
$productsTable->createProducts();

?>
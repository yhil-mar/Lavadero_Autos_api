<?php

// require_once 'database.php';

// use Database;

class CarsTable {
    
    protected $connection;
    
    public function __construct() {
        $database = new \Database();
        $this->connection = $database->getConnection();
    }

    public function createCars () {
        
        $query = "CREATE TABLE IF NOT EXISTS cars (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            matricula VARCHAR(6) UNIQUE NOT NULL,
            tipo VARCHAR(255) NOT NULL,
            whatsapp INT(13) NOT NULL,
            cliente VARCHAR(100),
            marca VARCHAR(100),
            modelo VARCHAR(100)
        )";
        
        $this->connection->query($query);
        
        }
    }

$carsTable = new CarsTable();
$carsTable->createCars();

?>
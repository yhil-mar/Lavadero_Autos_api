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
            licensePlate VARCHAR(6) PRIMARY KEY,    # El ID será la patente del vehículo
            vehicleType VARCHAR(20) NOT NULL,       # Podría ser un ENUM
            client VARCHAR(50) NOT NULL,
            whatsapp INT(11) NOT NULL,
            brand VARCHAR(30),
            model VARCHAR(30)
        )";
        
        return $this->connection->query($query);
        
        }
    }

$carsTable = new CarsTable();
$carsTable->createCars();

?>
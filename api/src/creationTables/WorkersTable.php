<?php

class WorkersTable {
    
    protected $connection;
    
    public function __construct() {
        $database = new \Database();
        $this->connection = $database->getConnection();
    }

    public function createWorkers () {
        
        $query = "CREATE TABLE IF NOT EXISTS workers (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(25) UNIQUE NOT NULL,
            rut_pasaporte VARCHAR(15) UNIQUE NOT NULL,
            direccion VARCHAR(25) NOT NULL,
            porcentaje_ganancia INT(3) NOT NULL,
            meta INT(10) NOT NULL,
            sucursal VARCHAR(15) NOT NULL
        )";
        
        $this->connection->query($query);
        
        }
    }

$workersTable = new WorkersTable();
$workersTable->createWorkers();

?>
<?php

class WorkersTable {
    
    protected $connection;
    
    public function __construct() {
        $database = new \Database();
        $this->connection = $database->getConnection();
    }

    public function createWorkers () {
        
        $query = "CREATE TABLE IF NOT EXISTS workers (
            rut_passport VARCHAR(15) PRIMARY KEY,
            name VARCHAR(25) UNIQUE NOT NULL,
            address VARCHAR(25) NOT NULL,
            profitPercentage INT(3) NOT NULL,
            percentageAfterGoal INT(3) NOT NULL,
            goal INT(10) NOT NULL,
            branch VARCHAR(15) NOT NULL,
            statusWorker ENUM('active', 'vacation', 'inactive') DEFAULT 'active'
            
        )";
        
        return $this->connection->query($query);
        
        }
    }

$workersTable = new WorkersTable();
$workersTable->createWorkers();

?>
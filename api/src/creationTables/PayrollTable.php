<?php

class PayrollTable {
    
    protected $connection;
    
    public function __construct() {
        $database = new \Database();
        $this->connection = $database->getConnection();
    }

    public function createPayroll () {
        
        $query = "CREATE TABLE IF NOT EXISTS payroll (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            date DATE NOT NULL,    
            workerName VARCHAR(30) NOT NULL, 
            workerId INT(15) NOT NULL,
            profit INT (15) NOT NULL,
            tip INT (15),          
            statusBill ENUM('paid', 'pending') DEFAULT 'pending'
            
        )";
        
        return $this->connection->query($query);
        
        }
    }

$payrollTable = new PayrollTable();
$payrollTable->createPayroll();

?>
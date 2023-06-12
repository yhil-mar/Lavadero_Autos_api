<?php

class ServicesTable {
    
    protected $connection;
    
    public function __construct() {
        $database = new \Database();
        $this->connection = $database->getConnection();
    }

    public function createServices () {
        
        $query = "CREATE TABLE IF NOT EXISTS services (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            serviceName VARCHAR(25) NOT NULL,
            vehicleType VARCHAR(20) NOT NULL,
            cost INT(13) NOT NULL            
        )";
        
        return $this->connection->query($query);
        
        }
    }

$servicesTable = new ServicesTable();
$servicesTable->createServices();

?>
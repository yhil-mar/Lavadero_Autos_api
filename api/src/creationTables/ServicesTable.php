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
            services_name VARCHAR(6) NOT NULL,
            tipo_veiculo VARCHAR(255) NOT NULL,
            costo INT(13) NOT NULL            
        )";
        
        $this->connection->query($query);
        
        }
    }

$servicesTable = new ServicesTable();
$servicesTable->createServices();

?>
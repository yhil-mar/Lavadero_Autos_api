<?php

class OrdersTable {
    
    protected $connection;
    
    public function __construct() {
        $database = new \Database();
        $this->connection = $database->getConnection();
    }

    public function createOrders() {
        
        $query = "CREATE TABLE IF NOT EXISTS orders (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            service_id INT(11) NOT NULL,
            car_id INT(11) NOT NULL,
            order_date DATETIME NOT NULL,
            fractional_cost INT(12) NOT NULL,
            total_cost INT(12) NOT NULL,
            order_status ENUM('pending', 'completed', 'cancelled') NOT NULL,
            FOREIGN KEY (service_id) REFERENCES services(id),
            FOREIGN KEY (car_id) REFERENCES cars(id)
        )";
        
        $this->connection->query($query);
        
    }
}

$ordersTable = new OrdersTable();
$ordersTable->createOrders();
?>
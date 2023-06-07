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
            order_service INT,
            car_id INT,
            service_id INT,
            worker_id INT,
            fractional_cost INT(12) NOT NULL,
            order_date DATETIME NOT NULL,
            order_status ENUM('pending', 'completed', 'cancelled') DEFAULT 'pending',
            FOREIGN KEY (car_id) REFERENCES cars(id),
            FOREIGN KEY (service_id) REFERENCES services(id),
            FOREIGN KEY (worker_id) REFERENCES workers(id)
        )";
        
        $this->connection->query($query);
        
    }
}

$ordersTable = new OrdersTable();
$ordersTable->createOrders();
?>
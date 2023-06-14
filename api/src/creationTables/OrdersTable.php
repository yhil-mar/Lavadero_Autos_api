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
            orderService VARCHAR(26),
            carId VARCHAR(6),
            serviceId INT,
            workerId INT,
            fractionalCost INT(15) NOT NULL,
            totalCost INT(15) NOT NULL,
            discountDay INT(15) DEFAULT 0,
            orderDay VARCHAR(2) NOT NULL,
            orderMonth VARCHAR(2) NOT NULL,
            orderYear INT(4) NOT NULL,
            orderHour VARCHAR(5) NOT NULL,
            orderStatus ENUM('pending', 'completed', 'cancelled') DEFAULT 'pending',
            invoiced INT(15),
            cancelReason VARCHAR(1000),
            FOREIGN KEY (carId) REFERENCES cars(id),
            FOREIGN KEY (serviceId) REFERENCES services(id),
            FOREIGN KEY (workerId) REFERENCES workers(rut_passport)
        )";
        
        return $this->connection->query($query);
        
    }
}

$ordersTable = new OrdersTable();
$ordersTable->createOrders();
?>
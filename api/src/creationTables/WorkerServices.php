<?php

class WorkerServices {
    
    protected $connection;
    
    public function __construct() {
        $database = new \Database();
        $this->connection = $database->getConnection();
    }

    public function createWorkerServices () {
        
        $query = "CREATE TABLE IF NOT EXISTS worker_services (
            service_id INT,
            worker_id INT,
            FOREIGN KEY (worker_id) REFERENCES workers(id),
            FOREIGN KEY (service_id) REFERENCES services(id)
        )";
        
        $this->connection->query($query);
        
        }
    }

$workerServices = new WorkerServices();
$workerServices->createWorkerServices();

?>
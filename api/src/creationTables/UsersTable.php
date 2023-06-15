<?php



class UsersTable {
    
    protected $connection;
    
    public function __construct() {
        $database = new \Database();
        $this->connection = $database->getConnection();
    }

    public function createUsers () {
        
        $query = "CREATE TABLE IF NOT EXISTS users (
            user_name VARCHAR(15) PRIMARY KEY,
            user_password VARCHAR(10) ,    
            user_type ENUM('admin', 'superadmin'), 
            user_status ENUM('active', 'inactive') DEFAULT 'active'
        )";
        
        $this->connection->query($query);
        
        }
    }

$usersTable = new UsersTable();
$usersTable->createUsers();

?>
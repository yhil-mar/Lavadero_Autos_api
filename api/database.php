<?php

// Se importará para la conexión a Base de datos MySQL
// use mysqli;

class Database
{
    // Declaración de las credenciales necesarias para la conexión a la base de datos
    protected $db_host = DB_HOST;
    protected $db_user = DB_USER;
    protected $db_pass = DB_PASS;
    protected $db_name = DB_NAME;

    protected $connection;

    public function __construct()
    {
        $this->connection();
    }

    public function connection()
    {
        $this->connection = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);

        if ($this->connection->connect_error) {
            die('Connection error: ' . $this->connection->connect_error);
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }

}
?>
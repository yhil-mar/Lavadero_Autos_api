<?php

    namespace Src\Models;

    // require_once 'database.php';

    class Model {
    
        protected $connection;

        // Constructor que ejecutará la función de conexión que viene del archivo db.php
        public function __construct() {
            $database = new \Database();
            $this->connection = $database->getConnection();
        }
        
        // Método para realizar una consulta a la base de datos
        public function query($sql) {
            $this->query = $this->connection->query($sql);
            return $this;
        }

        // ---- Métodos para obtener la información de la base de datos ---- //

        // Trae el primer registro encontrado
        public function first() {
            return $this->query->fetch_assoc();
        }

        // Trae todos los registros encontrados
        public function get() {
            return $this->query->fetch_all(MYSQLI_ASSOC);
        }

        // Consultas

        // Consulta para traer todos los registros de una tabla
        public function all() {
            $sql = "SELECT * FROM {$this->table}";
            return $this->query($sql)->get();
        }

        // Consulta para encontrar un registro de una tabla por ID
        public function find($id) {
            $sql = "SELECT * FROM {$this->table} WHERE id = {$id}";
            return $this->query($sql)->first();
        }

        // Consulta para crear un registro en un modelo
        public function create($data) {
            
            $columns = array_keys($data);
            $columns = implode(', ', $columns);
            
            $values = array_values($data);
            $values = "'" . implode("', '", $values) . "'";
            
            $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";
            
            $this->query($sql);
            
            $insert_id = $this->connection->insert_id;
        
            return $this->find($insert_id);
        }

        // Consulta para modificar un registro en un modelo
        public function update($id, $data) {
            $fields = [];

            foreach($data as $key => $value) {
                $fields[] = "{$key} = '{$value}'";
            }

            $fields = implode(', ', $fields);

            $sql = "UPDATE {$this->table} SET {$fields} WHERE id = {$id}";
            
            $this->query($sql);

            return $this->find($id);
        }

        // Consulta para eliminar un registro de un modelo
        public function delete($id) {
            $sql = "DELETE FROM {$this->table} WHERE id = {$id}";
            $this->query($sql);
        }

    }
?>
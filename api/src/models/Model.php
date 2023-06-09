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
            
            if($this->query) {

                return $this;
                
            } else {
                
                return ["Query error: " => $this->connection->error];

            }

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

            $response = $this->query($sql);

            
            if (!is_array($response)) {
                
                return $response->get();
                
            } else {
                
                return $response;

            }
        }

        // Consulta para buscar registros. Se debe especificar la propiedad a buscar, un operador
        // que es opcional y puede ser (<, >, >=, <=) y finalmente un valor para la propiedad
        public function where($column, $operator, $value = null) {

            if ($value == null) {
                $value = $operator;
                $operator = '=';
            }

            $sql = "SELECT * FROM {$this->table} WHERE {$column} {$operator} '{$value}'";

            return $this->query($sql);
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
        
            // return $this->find($insert_id);
            return ["status" => "created"];
        }

        // Consulta para modificar un registro en un modelo
        public function update($id, $data) {

            $fields = [];

            // Query para obtener la columna que contiene la PK de la tabla
            $sqlPK = "SHOW KEYS FROM {$this->table} WHERE Key_name = 'PRIMARY'";

            $primaryKeyColumn = $this->query($sqlPK)->first()['Column_name'];

            foreach($data as $key => $value) {
                $fields[] = "{$key} = '{$value}'";
            }

            $fields = implode(', ', $fields);

            $sql = "UPDATE {$this->table} SET {$fields} WHERE {$primaryKeyColumn} = '{$id}'";

            $this->query($sql);            

            // return $this->find($id);
            return ["status" => "updated"];

        }

        // Consulta para eliminar un registro de un modelo
        public function delete($id) {
            $sql = "DELETE FROM {$this->table} WHERE id = {$id}";
            $this->query($sql);
        }

    }
?>
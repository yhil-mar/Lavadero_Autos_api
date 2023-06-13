<?php

    // header('Content-Type: application/json');

    // Configurar encabezados para permitir peticiones desde cualquier origen
    header("Access-Control-Allow-Origin: *");

    // Configurar encabezados para permitir ciertos métodos HTTP
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

    // Configurar encabezados para permitir ciertos encabezados personalizados
    header("Access-Control-Allow-Headers: Content-Type, Authorization");

    // Permitir que las cookies se incluyan en las solicitudes (si es necesario)
    header("Access-Control-Allow-Credentials: true");

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        header('HTTP/1.1 200 OK');

        exit();

    }

    require_once('config/credentialsDb.php');

    require_once('autoload.php');

    require_once('src/creationTables/CarsTable.php');

    require_once('src/creationTables/WorkersTable.php');

    require_once('src/creationTables/ServicesTable.php');

    require_once('src/creationTables/OrdersTable.php');

    require_once('src/creationTables/ProductsTable.php');

    require_once('src/creationTables/UsersTable.php');

    require_once('src/creationTables/payrollTable.php');

    require_once('src/routes/index.php');
    
?>
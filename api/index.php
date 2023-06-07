<?php

    // header('Content-Type: application/json');

    require_once('config/credentialsDb.php');

    require_once('autoload.php');

    require_once('src/creationTables/CarsTable.php');

    require_once('src/creationTables/WorkersTable.php');

    require_once('src/creationTables/ServicesTable.php');

    require_once('src/creationTables/OrdersTable.php');

    require_once('src/routes/index.php');
    
?>
<?php

    // Importación del archivo que contiene las funciones para cada tipo de consulta y la función dispatch
    use Src\Lib\Route;

    // Importación de los controllers

    // Controllers para /cars
    use Src\Controllers\PostCars;

    // Controllers para /workers
    use Src\Controllers\PostWorkers;
    use Src\Controllers\GetWorkers;
    use Src\Controllers\PutWorkers;

    // Controllers para /services
    use Src\Controllers\PostServices;
    use Src\Controllers\GetAllServices;
    use Src\Controllers\PutServices;

    // Controllers para /orders
    use Src\Controllers\PostOrders;
    // use Src\Controllers\GetOrders;
    use Src\Controllers\PutOrders;

    // Por ahora se pondrán todas las rutas por acá, más adelante se modularizará mejor para cada modelo y sus consultas

    // Consultas para /cars

    Route::post('/cars', [PostCars::class, 'postCars']);
    
    // Consultas para /workers
    
    Route::post('/workers', [PostWorkers::class, 'postWorkers']);

    Route::get('/workers', [GetWorkers::class, 'getWorkers']);

    Route::put('/workers/:id', [PutWorkers::class, 'putWorkers']);

    // Consultas para /services
    
    Route::post('/services', [PostServices::class,'postServices']);

    Route::get('/services', [GetAllServices::class,'getAllServices']);

    Route::put('/services/:id', [PutServices::class,'putServices']);

    // Consultar para /orders

    Route::post('/orders', [PostOrders::class,'postOrders']);

    Route::get('/orders/filter', [GetOrders::class, 'getOrders']);

    // Route::put('/orders/:orderService', [PutOrders::class,'putOrders']);
    
    Route::dispatch();
?>
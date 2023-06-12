<?php

    // Importación del archivo que contiene las funciones para cada tipo de consulta y la función dispatch
    use Src\Lib\Route;

    // Importación de los controllers

    // Controllers para /cars
    use Src\Controllers\PostCars;
    use Src\Controllers\GetCarByLicense;
    use Src\Controllers\PutCars;

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
    use Src\Controllers\GetOrders;
    use Src\Controllers\GetOrdersByDate;
    use Src\Controllers\PutOrders;

    // Controllers para /products
    use Src\Controllers\PostProducts;
    use Src\Controllers\PutProducts;
    use Src\Controllers\GetAllProducts;
    use Src\Controllers\GetProductsById;

    // Controllers para /users
    use Src\Controllers\PostUsers;
    use Src\Controllers\PutUsers;
    use Src\Controllers\GetAllUsers;



    // Por ahora se pondrán todas las rutas por acá, más adelante se modularizará mejor para cada modelo y sus consultas

    // Consultas para /cars

    Route::post('/cars', [PostCars::class, 'postCars']);

    Route::get('/cars/:id', [GetCarByLicense::class, 'getCarByLicense']);
    
    Route::put('/cars/:id', [PutCars::class, 'putCars']);
    
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

    Route::get('/orders', [GetOrders::class, 'getOrders']);

    Route::get('/orders/date', [GetOrdersByDate::class, 'getOrdersByDate']);

    Route::put('/orders/:orderService', [PutOrders::class,'putOrders']);

    // Consultar para /products

    Route::post('/products', [PostProducts::class,'postProducts']);

    Route::put('/products/:id', [PutProducts::class,'putProducts']);

    Route::get('/products', [GetAllProducts::class,'getAllProducts']);

    Route::get('/products/:id', [GetProductsById::class,'getProductsById']);

    // Consultar para /products 
    
    Route::post('/users', [PostUsers::class,'postUsers']);

    Route::put('/users/:id', [PutUsers::class,'putUsers']);

    Route::get('/users', [GetAllUsers::class,'getAllUsers']);

    
    Route::dispatch();
?>
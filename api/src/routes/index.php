<?php

    // Importación del archivo que contiene las funciones para cada tipo de consulta y la función dispatch
    use Src\Lib\Route;

    // Importación de los controllers
    use Src\Controllers\PostCars;
    use Src\Controllers\PostWorkers;

    // Por ahora se pondrán todas las rutas por acá, más adelante se modularizará mejor para cada modelo y sus consultas

    // Consultas para /cars

    Route::get('/cars', function () {
        echo('hola desde /cars');
    });

    Route::post('/cars', [PostCars::class, 'postCars']);

    // Consultas para /workers

    Route::post('/workers', [PostWorkers::class, 'postWorkers']);

    Route::dispatch();
?>
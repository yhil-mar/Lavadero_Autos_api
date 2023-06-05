<?php

    use Src\Lib\Route;

    use Src\Controllers\PostCars;

    Route::get('/cars', function () {
        echo('hola desde /cars');
    });

    Route::post('/cars', [PostCars::class, 'postCars']);

    Route::dispatch();
?>
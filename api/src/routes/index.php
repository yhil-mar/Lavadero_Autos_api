<?php

    use Src\Lib\Route;

    use Src\Controllers\PostCars;
    use Src\Controllers\PostServices;

    Route::get('/cars', function () {
        echo('hola desde /cars');
    });

    Route::post('/cars', [PostCars::class, 'postCars']);
    Route::post('/services', [PostServices::class,'postServices']);

    Route::dispatch();
?>
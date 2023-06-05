<?php

    namespace Src\Controllers;

    use Src\Models\Car;

    class PostCars {
        
        public function postCars($body) {

            $carModel = new Car();

            return $carModel->create($body);
            
        }
    }

?>
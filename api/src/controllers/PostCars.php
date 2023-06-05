<?php

    namespace Src\Controllers;

    use Src\Models\Car;

    class PostCars {
        public function postCars($body) {

            $carModel = new Car();
            // echo ('Entró a cars con POST');
            return $carModel->create($body);
            
        }
    }

?>
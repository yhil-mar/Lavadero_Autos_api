<?php

    namespace Src\Controllers;

    use Src\Models\Car;

    class PostCars {
        
        public function postCars($body) {

            $carModel = new Car();

            $result = $carModel->create($body);

            if (!is_array($result)) {
                
                return ["status" => "created"];
                
            } else {
                
                return $result;

            }
        }
    }

?>
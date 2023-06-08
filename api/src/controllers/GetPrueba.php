<?php

    namespace Src\Controllers;

    use Src\Models\Car;

    class GetPrueba {
        
        public function getPrueba () {

            $carModel = new Car();

            $sql = "SELECT * FROM services";

            $response = $carModel->query($sql);

            if (!$response) {

                return ["message" => "No results found"];
                
            } else {

                return $response;

            }
            
        }
    }

?>
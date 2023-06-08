<?php

    namespace Src\Controllers;

    use Src\Models\Car;

    class GetCarByLicense {
        
        public function getCarByLicense ($id) {

            $carModel = new Car();

            $response = $carModel->where("licensePlate", $id)->first();

            if (!$response) {

                return ["message" => "No results found"];
                
            } else {

                return $response;

            }
            
        }
    }

?>
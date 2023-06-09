<?php

    namespace Src\Controllers;

    use Src\Models\Car;

    class GetPrueba {
        
        public function getPrueba ($id) {

            $carModel = new Car();

            $response = $carModel->where("licensePlate", $id);

            if (!is_array($response)) {
                                
                return $response->first();

            } else {
                
                return $response;

            }
            
        }
        
    }

?>
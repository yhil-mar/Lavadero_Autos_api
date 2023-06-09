<?php

    namespace Src\Controllers;

    use Src\Models\Car;

    class GetCarByLicense {
        
        public function getCarByLicense ($id) {

            $carModel = new Car();

            $response = $carModel->where("licensePlate", $id);

            if (!is_array($response)) {
                
                $response = $response->first();

                if ($response) {

                    return $response;
    
                } else {
    
                    return ['status' => 'No results found'];
    
                }                                

            } else {
                
                return $response;

            }
            
        }
    }

?>
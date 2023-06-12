<?php

    namespace Src\Controllers;

    use Src\Models\Car;

    class PutCars {
        
        public function putCars($id, $data) {

            $carModel = new Car();

            $result = $carModel->update($id ,$data);

            if (!is_array($result)) {
                
                return ["status" => "updated"];
                
            } else {
                
                return $result;

            }

        }

    }

?>
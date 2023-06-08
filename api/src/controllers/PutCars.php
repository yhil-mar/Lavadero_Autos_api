<?php

    namespace Src\Controllers;

    use Src\Models\Car;

    class PutCars {
        
        public function putCars($id, $data) {

            $carModel = new Car();

            return $carModel->update($id ,$data);
            
        }

    }

?>
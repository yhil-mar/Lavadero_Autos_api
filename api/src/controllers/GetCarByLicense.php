<?php

    namespace Src\Controllers;

    use Src\Models\Car;

    class GetCarByLicense {
        
        public function getCarByLicense ($id) {

            $carModel = new Car();

            return $carModel->where("licensePlate",$id)->first();
            
        }
    }

?>
<?php

    namespace Src\Controllers;

    use Src\Models\Service;

    class GetAllServices {
        
        public function getAllServices() {

            $serviceModel = new Service();

            return $serviceModel->all();
            
        }
    }

?>
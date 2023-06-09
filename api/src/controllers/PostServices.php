<?php

    namespace Src\Controllers;

    use Src\Models\Service;

    class PostServices {
        public function postServices($body) {

            $serviceModel = new Service();            
            return $serviceModel->create($body);
            
        }
    }

?>
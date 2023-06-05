<?php

    namespace Src\Controllers;

    use Src\Models\Service;

    class PostServices {
        public function postServices($body) {

            $serviceModel = new Service();
            // echo ('Entró a service con POST');
            return $serviceModel->create($body);
            
        }
    }

?>
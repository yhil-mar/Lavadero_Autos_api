<?php

    namespace Src\Controllers;

    use Src\Models\Service;

    class PostServices {

        public function postServices($body) {

            $serviceModel = new Service();   

            $result = $serviceModel->create($body);

            if (!is_array($result)) {
                
                return ["status" => "created"];
                
            } else {
                
                return $result;

            }
            
        }
    }

?>
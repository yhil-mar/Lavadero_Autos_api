<?php

    namespace Src\Controllers;

    use Src\Models\Service;

    class PutServices {
        
        public function putServices($id, $data) {

            $serviceModel = new Service();

            $result = $serviceModel->update($id ,$data);

            if (!is_array($result)) {
                
                return ["status" => "updated"];
                
            } else {
                
                return $result;

            }
            
        }

    }

?>
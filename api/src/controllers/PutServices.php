<?php

    namespace Src\Controllers;

    use Src\Models\Service;

    class PutServices {
        
        public function putServices($id, $data) {

            $serviceModel = new Service();

            return $serviceModel->update($id ,$data);
            
        }

    }

?>
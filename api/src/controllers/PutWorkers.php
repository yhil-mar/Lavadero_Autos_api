<?php

    namespace Src\Controllers;

    use Src\Models\Worker;

    class PutWorkers {
        
        public function putWorkers($id, $body) {

            $workerModel = new Worker();

            $result = $workerModel->update($id, $body);

            if (!is_array($result)) {
                
                return ["status" => "updated"];
                
            } else {
                
                return $result;

            }
            
        }
    }

?>
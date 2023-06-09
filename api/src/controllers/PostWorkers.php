<?php

    namespace Src\Controllers;

    use Src\Models\Worker;

    class PostWorkers {
        
        public function postWorkers($body) {

            $workerModel = new Worker();

            $result = $workerModel->create($body);

            if (!is_array($result)) {
                
                return ["status" => "created"];
                
            } else {
                
                return $result;

            }
            
        }
            
    }

?>
<?php

    namespace Src\Controllers;

    use Src\Models\Worker;

    class PostWorkers {
        
        public function postWorkers($body) {

            $workerModel = new Worker();

            return $workerModel->create($body);
            
        }
    }

?>
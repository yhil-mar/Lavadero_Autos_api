<?php

    namespace Src\Controllers;

    use Src\Models\Worker;

    class PutWorkers {
        
        public function putWorkers($id, $body) {

            $workerModel = new Worker();

            return $workerModel->update($id, $body);
            
        }
    }

?>
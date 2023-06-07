<?php

    namespace Src\Controllers;

    use Src\Models\Worker;

    class GetWorkers {
        
        public function getWorkers() {

            $workerModel = new Worker();

            return $workerModel->all();
            
        }
    }

?>
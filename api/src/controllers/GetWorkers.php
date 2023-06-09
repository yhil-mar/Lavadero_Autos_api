<?php

    namespace Src\Controllers;

    use Src\Models\Worker;

    class GetWorkers {
        
        public function getWorkers($query = null) {

            $workerModel = new Worker();

            return $workerModel->all();

        }
    }

?>
<?php

    namespace Src\Controllers;

    use Src\Models\Worker;

    class GetWorkers {
        
        public function getWorkers($query = null) {

            $workerModel = new Worker();

            if (isset($query) && !empty($query)) {

                $column = key($query);
                $value = current($query);

                return $workerModel->where($column, $value)->get();
            
            }

            else {

                return $workerModel->all();

            }
            
        }
    }

?>
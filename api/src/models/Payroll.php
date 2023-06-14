<?php

namespace Src\Models;

class Payroll extends Model {

        protected $table = 'payroll';

        public function createPayrolls($date){

            $payrolls = $this->all();

            $actualDate = null;

            if (count($payrolls) > 0) {

                $actualDate = end($payrolls)['date'];

                $actualDate = str_replace("-", "", $actualDate);
            }
            
            if ($actualDate != null && $actualDate == $date['date']) {

                return ["status" => "not created"];

            } else {

                $workers = $this->allTable('workers');

                foreach ($workers as $worker) {
                    
                    $payrollBody = [];

                    $payrollBody['date'] = $date['date'];

                    $payrollBody['workerName'] = $worker['name'];

                    $payrollBody['workerId'] = $worker['rut_passport'];

                    $payrollBody['goal'] = $worker['goal'];

                    $payrollBody['profit'] = 0;

                    $payroll = $this->createTable($payrollBody, 'payroll');

                    if (is_array($payroll)) {
                
                        return $payroll;

                    }

                }

                return ["status" => "created"];

            }

        }
        
    }

?>
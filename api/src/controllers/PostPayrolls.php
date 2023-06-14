<?php

    namespace Src\Controllers;

    use Src\Models\Payroll;

    class PostPayrolls {
        
        public function postPayrolls($body) {

            $payrollModel = new Payroll();

            $result = $payrollModel->createPayrolls($body);

            if (!is_array($result)) {
                
                return $result;
                
            } else {
                
                return $result;

            }
            
        }
    }

?>
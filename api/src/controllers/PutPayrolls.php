<?php

    namespace Src\Controllers;

    use Src\Models\Payroll;

    class PutPayrolls {
        
        public function putPayrolls($ids, $body) {

            $payrollModel = new Payroll();

            $ids = explode('o', $ids);

            foreach ($ids as $id) {

                $result = $payrollModel->update($id, $body);

                if (is_array($result)) {
                
                    return $result;
                    
                }

            }

            return ['status' => 'updated'];
            
        }
    }

?>
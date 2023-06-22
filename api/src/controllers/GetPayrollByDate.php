<?php

namespace Src\Controllers;

use Src\Models\Payroll;

class GetPayrollByDate {
    
    public function getPayrollByDate($query = null) {

        $payrollModel = new Payroll();

        if (isset($query) && !empty($query)) {

            $workerId = $query['workerId'];            
            
            $sql = "SELECT * FROM payroll WHERE workerId = '$workerId' AND statusBill = 'pending'";
            
            $result = $payrollModel->query($sql);
            
            if (!is_array($result)) {
                
                $result = $result->get();

                if(!empty($result)) {

                    $startDate = $result[0]['date'];
                
                    $endDate = end($result)['date'];

                    $ids = null;

                    $payment = 0;

                    $tip = 0;

                    foreach ($result as $day) {

                        $ids = $ids . $day['id'] . 'o';

                        $payment = $payment + $day['payment'];

                        $tip = $tip + $day['tip'];

                    }

                    $ids = substr($ids, 0, -1);

                    $finalObject = [];

                    $finalObject['ids'] = $ids;

                    $finalObject['date'] = $startDate . ' - ' . $endDate;

                    $finalObject['workerName'] = $result[0]['workerName'];

                    $finalObject['workerId'] = $result[0]['workerId'];

                    $finalObject['payment'] = $payment;

                    $finalObject['tip'] = $tip;

                    return $finalObject;

                } else {

                    return ['status' => 'No results found'];
                    
                }

            } else {
                
                return $result;

            }

        }

        else {

            $result = $payrollModel->all();

            return $result;

        }

    }

}

?>
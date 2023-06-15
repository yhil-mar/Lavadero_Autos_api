<?php

namespace Src\Controllers;

use Src\Models\Payroll;

class GetPayrollByDate {
    
    public function getPayrollByDate($query = null) {

        $payrollModel = new Payroll();

        if (isset($query) && !empty($query)) {

            $workerId = $query['workerId'];

            $startDate = $query['startDate'];

            $endDate = $query['endDate'];


            $sql = "SELECT * FROM payroll WHERE date >= '$startDate' AND date <= '$endDate' AND workerId = '$workerId' AND statusBill = 'pending'";

            $result = $payrollModel->query($sql);

            if (!is_array($result)) {
                
                $result = $result->get();

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
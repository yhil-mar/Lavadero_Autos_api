<?php

namespace Src\Controllers;

use Src\Models\Payroll;

class GetPayrollByDay {
    
    public function getPayrollByDay($date) {
        $payrollModel = new Payroll();
        $sql = "SELECT workerName, goal, profit FROM payroll WHERE date = '$date'";
        $result = $payrollModel->query($sql);
    
        $payrollArray = [];
        while ($row = $result->first()) {
            $payrollArray[] = $row;
        }
    
        return $payrollArray;
    }
}

?>
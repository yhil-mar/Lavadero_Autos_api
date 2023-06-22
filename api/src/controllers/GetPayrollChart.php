<?php

namespace Src\Controllers;

use Src\Models\Payroll;

class GetPayrollChart {

    public function getPayrollChart($query = null) {

        $payrollModel = new Payroll();

        if (isset($query) && !empty($query)) {

            $startDate = $query['startDate'];

            $endDate = $query['endDate'];


            $sql = "SELECT workerName, goal, profit FROM payroll WHERE date >= '$startDate' AND date <= '$endDate'";

            $result = $payrollModel->query($sql);

            $data = $result->get();

            return array_reduce($data, function ($carry, $item) {
                $name = $item['workerName'];
                unset($item['workerName']);

                $carry[$name] = $carry[$name] ?? [];


                foreach ($item as $key => $val) {
                    $carry[$name][$key] = $carry[$name][$key] ?? 0;
                    if($key === "profit") $carry[$name][$key] += $val;
                    else $carry[$name][$key] = $val;
                }

                return $carry;
            }, []);

        }

        else {

            $result = $payrollModel->all();

            return $result;

        }

    }

}

?>
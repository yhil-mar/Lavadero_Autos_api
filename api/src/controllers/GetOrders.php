<?php

    namespace Src\Controllers;

    use Src\Models\Order;

    class GetOrders {
        
        public function getOrders($query = null) {

            $orderModel = new Order();

            if (isset($query) && !empty($query)) {

                $amountQuery = count($query);

                if ($amountQuery < 2) {

                    $column = key($query);
                    $value = current($query);
    
                    return $orderModel->where($column, $value)->get();

                } else {                   

                    foreach ($query as $queryKey => $queryValue) {
                        switch ($queryKey) {
                            case 'workerId':

                                $workerId= $queryValue;

                                break;
                            case 'date1':

                                $startDate=$queryValue;                               
                            
                            break;
                            case 'date2':

                                $endDate=$queryValue;                                

                            break;
                            default:
                            break;
                        }
                    }


                    $startYear = substr($startDate, 0, 4);
                    $startMonth = substr($startDate, 4, 2);
                    $startDay = substr($startDate, 6, 2);

                    $endYear = substr($endDate, 0, 4);
                    $endMonth = substr($endDate, 4, 2);
                    $endDay = substr($endDate, 6, 2);
        
                    $sql = "SELECT * FROM orders 
                      WHERE workerId = $workerId 
                      AND orderStatus = 'completed' 
                      AND orderYear >= $startYear
                      AND orderYear <= $endYear
                      AND orderMonth >= $startMonth
                      AND orderMonth <= $endMonth
                      AND orderDay >= $startDay
                      AND orderDay <= $endDay";
                  
                  return $orderModel->query($sql)->get();     

                }

            
            }

            else {

                return $orderModel->all();

            }
            
        }

    }

?>
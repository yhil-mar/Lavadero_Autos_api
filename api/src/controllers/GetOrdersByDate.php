<?php

    namespace Src\Controllers;

    use Src\Models\Order;

    class GetOrdersByDate {
        
        public function getOrdersByDate($query = null) {

            $orderModel = new Order();

            if (isset($query) && !empty($query)) {

                $amountQuery = count($query);
                  
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
                  
                  $response = $orderModel->query($sql);                  
                  
                  
                  if (!is_array($response)) {
                                
                    $arrayforedit = $response->get();

                    $firstElement = reset($arrayforedit);

                    unset($firstElement['totalCost']);

                    $workerId = $firstElement['workerId'];

                    echo ($workerId);

                    return $firstElement;
    
                }

                   
            }

            else {

                return $orderModel->all();

            }
            
        }

    }

?>
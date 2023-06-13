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

                    $finalArray = reset($arrayforedit);

                    foreach ($arrayforedit as &$item) {
                        unset($item['totalCost']);
                        unset($item['id']);
                        unset($item['serviceId']);
                    
                        $workerId = $item['workerId'];
                        $orderDay = $item['orderDay'];
                        $orderMonth = $item['orderMonth'];
                        $orderYear = $item['orderYear'];
                    
                        $orderDate = $orderYear . $orderMonth . $orderDay;
                    
                        unset($item['orderDay']);
                        unset($item['orderMonth']);
                        unset($item['orderYear']);
                    
                        $sql = "SELECT name FROM workers WHERE rut_passport = {$workerId}";
                        $workerName = $orderModel->query($sql)->get();
                        $item['workerName'] = $workerName;
                        $item['workerName'] = $item['workerName'][0]['name'];
                    
                        $sql = "SELECT profitPercentage FROM workers WHERE rut_passport = {$workerId}";
                        $profitPercentage = $orderModel->query($sql)->get();
                        $item['profitPercentage'] = $profitPercentage;
                        $item['profitPercentage'] = $item['profitPercentage'][0]['profitPercentage'];
                    
                        $sql = "SELECT goal FROM workers WHERE rut_passport = {$workerId}";
                        $goal = $orderModel->query($sql)->get();
                        $item['goal'] = $goal;
                        $item['goal'] = $item['goal'][0]['goal'];
                    
                        $item['ordeDate'] = $orderDate;
                    }
                    
                    return $arrayforedit;
                        
                }

                   
            }

            else {

                return $orderModel->all();

            }
            
        }

    }

?>
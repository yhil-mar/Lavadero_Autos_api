<?php

    namespace Src\Controllers;

    use Src\Models\Order;

    class PutOrders {
        
        public function putOrders($id, $body) {

            $orderModel = new Order();

            if (in_array('completed', $body)) {

                $tip = $body['tip'];

                unset($body['tip']);
                
                $result = $orderModel->updateOrders($id ,$body);
                
                if (!is_array($result)) {
                    
                    $workerInfo = $orderModel->whereTable('workerId, orderYear, orderMonth, orderDay, fractionalCost', 'orders', 'orderService', $id);

                    if (!is_array($workerInfo)) {
                
                        $workerInfo = $workerInfo->get();

                        $amountWorkers = count($workerInfo);

                        $tip = $tip / $amountWorkers;

                        foreach ($workerInfo as $worker) {

                            $year = $worker['orderYear'];

                            $month = $worker['orderMonth'];
    
                            $day = $worker['orderDay'];
        
                            $date = $year . $month . $day;
                            
                            $workerId = $worker['workerId'];

                            $fractionalCost = $worker['fractionalCost'];
                            
                            $sql = "SELECT id, tip, profit FROM payroll WHERE date = $date AND workerId = $workerId";
                            
                            $result = $orderModel->query($sql);
                                                        
                            if (!is_array($result)) {
                                
                                $result = $result->first();
                                
                                $payrollBody = [];

                                $payrollBody['profit'] = $result['profit'] + $fractionalCost;

                                $payrollBody['tip'] = $result['tip'] + $tip;

                                $payroll = $orderModel->updateTable($result['id'], $payrollBody, 'payroll');

                                if (is_array($payroll)) {
                
                                    return $payroll;
                                    
                                }
                                
                            } else {
                                
                                return $result;
                
                            }

                        }

                        return ["status" => "updated"];

                    } else {
                        
                        return $workerInfo;
        
                    }

                } else {
                    
                    return $result;
    
                }


            } else {
                    
                $result = $orderModel->updateOrders($id ,$body);

                if (!is_array($result)) {
                
                    return ["status" => "updated"];
                    
                } else {
                    
                    return $result;
    
                }

            }
                

                    
                

            
        }

    }

?>
<?php

    namespace Src\Controllers;

    use Src\Models\Order;

    class GetOrdersByDate {
        
        public function getOrdersByDate($query = null) {

            $orderModel = new Order();

            if (isset($query) && !empty($query)) {

                $startDate = $query['startDate'];

                $endDate = $query['endDate'];

                $startYear = substr($startDate, 0, 4);
                $startMonth = substr($startDate, 4, 2);
                $startDay = substr($startDate, 6, 2);

                $endYear = substr($endDate, 0, 4);
                $endMonth = substr($endDate, 4, 2);
                $endDay = substr($endDate, 6, 2);

                $sql = "SELECT * FROM orders 
                WHERE orderStatus = 'completed' 
                AND orderYear >= $startYear
                AND orderYear <= $endYear
                AND orderMonth >= $startMonth
                AND orderMonth <= $endMonth
                AND orderDay >= $startDay
                AND orderDay <= $endDay";


                $result = $orderModel->query($sql);

                if (!is_array($result)) {

                    $result = $result->get();

                    $previousOrder = 0;
                    $finalArray = [];

                    foreach($result as $order){
                        $currentOrder = $order['orderService'];

                        if($currentOrder != $previousOrder){
                            $finalArray[]=$order;
                            
                        }

                        // echo ($previousOrder . " - " . $currentOrder);
                        // echo ('<br>');
                        
                        $previousOrder = $currentOrder;
                        
                    }

                    return $finalArray;
                    
                    



                } else {
                    return $result;
                
                }                     
           
            }
            
        }

    }

?>
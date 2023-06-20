<?php

    namespace Src\Controllers;

    use Src\Models\Order;

    class GetOrders {
        
        public function getOrders($query = null) {

            $orderModel = new Order();

            if (isset($query) && !empty($query)) {

                $result = $orderModel->findOrders($query);

            }

            else {

                $result = $orderModel->all();

            }

            if (count($result) > 0) {
                if($query['orderStatus'] === 'cancelled'){
                    
                    $previousOrder = 0;  
                    
                    $finalArray = [];

                    foreach($result as $order){

                        $currentOrder = $order['orderService'];

                        if($currentOrder != $previousOrder){
                            
                            $cancelOrder = [];

                            $carId = $order['carId'];

                            $orderYear = $order['orderYear'];
                            $orderMonth = $order['orderMonth'];
                            $orderDay = $order['orderDay'];

                            $orderDate = $orderYear . '-' . $orderMonth . '-' . $orderDay;

                            $cancelReason = $order['cancelReason'];

                            $serviceName = $orderModel->whereTable('serviceName', 'services', 'id', $order['serviceId']);

                            if(!is_array($serviceName)){

                                $serviceName = $serviceName->first();

                                $serviceName = $serviceName['serviceName'];

                                $clientName = $orderModel->whereTable('client', 'cars', 'licensePlate', $carId);

                                if(!is_array($serviceName)){

                                    $clientName = $clientName->first();

                                    $clientName = $clientName['client'];

                                    $cancelOrder['orderService'] = $currentOrder;

                                    $cancelOrder['serviceName'] = $serviceName;

                                    $cancelOrder['client'] = $clientName;

                                    $cancelOrder['orderDate'] = $orderDate;

                                    $cancelOrder['cancelReason'] = $order['cancelReason'];
                                
                                } else {

                                    return $clientName;
    
                                }
                                
                            } else {

                                return $serviceName;

                            }

                            $finalArray[] = $cancelOrder;

                        }
                        
                        $previousOrder = $currentOrder;
                        
                    }

                    return $finalArray ;

                }

                return $orderModel->fixOrders($result);

            } else {

                return ['status' => 'No results found'];

            }
            
        }

    }

?>
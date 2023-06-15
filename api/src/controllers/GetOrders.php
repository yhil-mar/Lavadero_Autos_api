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
                    
                    $finalArray =[];

                    

                    foreach($result as $order){

                        $currentOrder = $order['orderService'];

                        if($currentOrder != $previousOrder){
                            
                            $cancelReason = $order['cancelReason'];

                            $serviceName = $orderModel->whereTable('serviceName', 'services', 'id', $order['serviceId']);

                            if(!is_array($serviceName)){
                                $serviceName = $serviceName->first();
                                
                                $serviceName['orderService']=$currentOrder;
                                $serviceName['cancelReason']=$cancelReason;
                                
                            }else{
                                return $serviceName;
                            }

                            $finalArray[]=$serviceName;


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
<?php

    namespace Src\Controllers;

    use Src\Models\Order;

    class DeleteOrders {
        
        public function deleteOrders($id) {

            $orderModel = new Order();

            $result = $orderModel->delete($id,'orderService');

            if (!is_array($result)) {                
                            
                return ["status" => "OrderService deleted"];
    
            } else {
    
                return $result;

            }
            
        }
    }

?>
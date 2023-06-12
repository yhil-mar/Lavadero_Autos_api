<?php

    namespace Src\Controllers;

    use Src\Models\Order;

    class PutOrders {
        
        public function putOrders($id, $body) {

            $orderModel = new Order();

            $result = $orderModel->updateOrders($id ,$body);

            if (!is_array($result)) {
                
                return ["status" => "updated"];
                
            } else {
                
                return $result;

            }
            
        }

    }

?>
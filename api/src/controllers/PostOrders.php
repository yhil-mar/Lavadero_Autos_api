<?php

    namespace Src\Controllers;

    use Src\Models\Order;

    class PostOrders {
        
        public function postOrders($body) {

            $orderModel = new Order();

            $result = $orderModel->createRelation($body);

            if (!is_array($result)) {
                            
                return ["status" => "Information uploaded"];
    
            } else {
    
                return $result;

            }
            
        }
    }

?>
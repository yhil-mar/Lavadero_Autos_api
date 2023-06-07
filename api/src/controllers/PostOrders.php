<?php

    namespace Src\Controllers;

    use Src\Models\Order;

    class PostOrders {
        
        public function postOrders($body) {

            $orderModel = new Order();

            return $orderModel->createRelation($body);
            
        }
    }

?>
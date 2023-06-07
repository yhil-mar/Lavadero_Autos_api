<?php

    namespace Src\Controllers;

    use Src\Models\Order;

    class PutOrders {
        
        public function putOrders($id, $body) {

            $orderModel = new Order();

            return $orderModel->updateOrders($id ,$body);
            
        }

    }

?>
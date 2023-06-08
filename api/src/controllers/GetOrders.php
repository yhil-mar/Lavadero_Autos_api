<?php

    namespace Src\Controllers;

    use Src\Models\Order;

    class GetOrders {
        
        public function getOrders() {

            $orderModel = new Order();

            $filter = $_GET['status'];

            echo($filter);

            // return $orderModel->all();
            
        }

    }

?>
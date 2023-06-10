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

                return $orderModel->fixOrders($result);

            } else {

                return ['status' => 'No results found'];

            }
            
        }

    }

?>
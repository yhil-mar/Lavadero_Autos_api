<?php

    namespace Src\Controllers;

    use Src\Models\Order;

    class GetOrders {
        
        public function getOrders($query = null) {

            $orderModel = new Order();

            if (isset($query) && !empty($query)) {

                $column = $query[0];
                $value = $query[1];

                return $orderModel->where($column, $value);
            
            }

            else {

                return $orderModel->all();

            }
            
        }

    }

?>
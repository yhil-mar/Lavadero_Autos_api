<?php

    namespace Src\Controllers;

    use Src\Models\Order;

    class GetOrders {
        
        public function getOrders($query = null) {

            $orderModel = new Order();

            if (isset($query) && !empty($query)) {

                $column = key($query);
                $value = current($query);

                return $orderModel->where($column, $value)->get();
            
            }

            else {

                return $orderModel->all();

            }
            
        }

    }

?>
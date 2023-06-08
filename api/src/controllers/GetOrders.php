<?php

    namespace Src\Controllers;

    use Src\Models\Order;

    class GetOrders {
        
        public function getOrders($query = null) {

            $orderModel = new Order();

            if (isset($query) && !empty($query)) {

                $amountQuery = count($query);

                if ($amountQuery < 2) {

                    $column = key($query);
                    $value = current($query);
    
                    return $orderModel->where($column, $value)->get();

                } else {

                    

                    // foreach ($query as $queryKey => $queryValue) {

                    //     switch ($key) {
                    //         case 'workerId':

                    //            $result = $orderModel->where($queryKey, $queryValue)->get();

                    //         break;

                    //         case 'date1':

                    //             foreach ($result as $resultKey => $resultValue) {
                    //                 if () {

                    //                 }
                    //             }
                            
                    //         break;

                    //         case 'date2':

                    //         break;

                    //         default:

                    //         break;
                    //     }
                    // }

                }

            
            }

            else {

                return $orderModel->all();

            }
            
        }

    }

?>
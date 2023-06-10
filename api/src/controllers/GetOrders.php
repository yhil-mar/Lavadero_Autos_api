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

                $finalArray = [];

                $contador = 0;

                foreach ($result as $service) {

                    foreach ($service as $serviceKey => $serviceValue) {

                        switch($serviceKey) {
                            
                            case 'carId':
                                
                                $sql = "SELECT * FROM cars WHERE licensePlate = '$serviceValue'";
                                
                                // echo ($serviceValue);
                                $vehicleResult = $orderModel->query($sql);

                                $vehicleResult = $vehicleResult->first();

                                $finalArray[] = $vehicleResult;

                                $finalArray[$contador]['services'] = array();
    
                                break;
                            
                            case 'serviceId':

                                $sql = "SELECT serviceName, cost FROM services WHERE id = '$serviceValue'";

                                $serviceResult = $orderModel->query($sql);
                                
                                $serviceResult = $serviceResult->first();

                                $finalArray[$contador]['services'][] = $serviceResult;

                                // $finalArray[$contador]['services']['workers'] = array();

                                break;
                            
                            case 'workerId':

                                

                                break;
    
                            default:

                                break;
                        }

                        
                    }
                    
                    $contador = $contador + 1;
                    
                    // echo print_r($service);
                }
                
                return $finalArray;

                // return $result;

            } else {

                return ['status' => 'No results found'];

            }
            
        }

    }

?>
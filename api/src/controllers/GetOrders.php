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

                // $licensePlates = array_values(array_unique(array_column($result, 'carId')));

                $previousLicense = null;

                $previousService = null;

                $previousOrder = null;

                $contadorVehiculos = -1;
                
                foreach ($result as $service) {

                    $currentLicense = $service['carId'];

                    $currentService = $service['serviceId'];
                    
                    $currentWorker = $service['workerId'];

                    $currentOrder = $service['orderService'];

                    if ($currentLicense != $previousLicense) {
                        
                        $contadorVehiculos = $contadorVehiculos + 1;
                        
                        $contadorServicios = -1;

                        $contadorServicios = $contadorServicios + 1;

                        $sql = "SELECT * FROM cars WHERE licensePlate = '$currentLicense'";
                        
                        $vehicleResult = $orderModel->query($sql);
                        
                        $vehicleResult = $vehicleResult->first();
                        
                        $finalArray[] = $vehicleResult;
                        
                        $finalArray[$contadorVehiculos]['services'] = array();
                        

                        $sql = "SELECT serviceName, cost FROM services WHERE id = '$currentService'";

                        $serviceResult = $orderModel->query($sql);
                        
                        $serviceResult = $serviceResult->first();
                        
                        $finalArray[$contadorVehiculos]['services'][] = $serviceResult;
                        
                        $finalArray[$contadorVehiculos]['services'][0]['workers'] = array();
                        
                        
                        $sql = "SELECT name FROM workers WHERE rut_passport = '$currentWorker'";
                        
                        $workerResult = $orderModel->query($sql);
                        
                        $workerResult = array_values($workerResult->first());
                        
                        $finalArray[$contadorVehiculos]['services'][0]['workers'] = $workerResult;
                        

                        $serviceDate = $service['orderDay'] . '-' . $service['orderMonth'] . '-' . $service['orderYear'] . ' ' . $service['orderHour'];

                        $finalArray[$contadorVehiculos]['services'][0]['date'] = $serviceDate;


                        $previousLicense = $currentLicense;

                        $previousService = $currentService;

                    } else {

                        if ($currentService != $previousService || $currentOrder != $previousOrder) {

                            $contadorServicios = $contadorServicios + 1;

                            $sql = "SELECT serviceName, cost FROM services WHERE id = '$currentService'";

                            $serviceResult = $orderModel->query($sql);
                                    
                            $serviceResult = $serviceResult->first();

                            array_push($finalArray[$contadorVehiculos]['services'], $serviceResult);
        
                            $finalArray[$contadorVehiculos]['services'][$contadorServicios]['workers'] = array();


                            $sql = "SELECT name FROM workers WHERE rut_passport = '$currentWorker'";

                            $workerResult = $orderModel->query($sql);
                                    
                            $workerResult = array_values($workerResult->first());
    
                            $finalArray[$contadorVehiculos]['services'][$contadorServicios]['workers'] = $workerResult;


                            $serviceDate = $service['orderDay'] . '-' . $service['orderMonth'] . '-' . $service['orderYear'] . ' ' . $service['orderHour'];

                            $finalArray[$contadorVehiculos]['services'][$contadorServicios]['date'] = $serviceDate;


                            $previousService = $currentService;

                        } else {

                            $sql = "SELECT name FROM workers WHERE rut_passport = '$currentWorker'";

                            $workerResult = $orderModel->query($sql);
                                    
                            $workerResult = array_values($workerResult->first());

                            array_push($finalArray[$contadorVehiculos]['services'][$contadorServicios]['workers'], $workerResult[0]);

                        }

                    }

                    $previousOrder = $currentOrder;
                        
                }

                return $finalArray;

            } else {

                return ['status' => 'No results found'];

            }
            
        }

    }

?>
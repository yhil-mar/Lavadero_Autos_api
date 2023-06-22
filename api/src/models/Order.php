<?php

namespace Src\Models;

class Order extends Model {

        protected $table = 'orders';

        public function createRelation($body) {
            
            foreach($body as $key => $value) {
                if($key == 'idVehicle') {
                    $idVehicle = $value;
                }

                if($key == 'services') {
                    foreach($value as $serviceKey => $serviceValue) {

                        foreach($serviceValue as $elemKey => $elemValue) {
                            
                            switch ($elemKey) {
                                case 'idService':

                                    $idService = $elemValue;

                                    break;

                                case 'date':

                                    $orderYear = substr($elemValue, 0, 4);
                                    $orderMonth = substr($elemValue, 4, 2);
                                    $orderDay = substr($elemValue, 6, 2);
                                    $orderHour = substr($elemValue, 8, 4);

                                    $hour = substr($orderHour, 0, 2);
                                    $minutes = substr($orderHour, 2, 2);

                                    $finalHour = date("H:i:s", strtotime("$hour:$minutes"));
                                    
                                    $orderService = $idVehicle . $orderYear . $orderMonth . $orderDay . $orderHour . $idService;
                                    
                                    break;
                                
                                case 'workers':

                                    $amountWorkers = count($elemValue);

                                    $costResult = $this->whereTable('cost, discountDay', 'services', 'id', $idService);

                                    if (!is_array($costResult)) {
                            
                                        $costResult = $costResult->first();

                                        $cost = $costResult['cost'];
                                        $discount = $costResult['discountDay'];

                                        $totalCost = $cost - $discount;
                            
                                    } else {
                            
                                        return $costResult;
            
                                    }

                                    $fraccion = ceil($cost / $amountWorkers); // pago total a trabajador

                                    // $fraccion = ceil($totalCost / $amountWorkers); // pago restando el descuento a trabajador
                                    
                                    foreach($elemValue as $idWorker) {

                                        $sql = "INSERT INTO {$this->table} (orderService, carId, serviceId, workerId, fractionalCost, totalCost, discountDay, orderDay, orderMonth, orderYear, orderHour)
                                            VALUES ('$orderService', '$idVehicle', '$idService', '$idWorker', '$fraccion', '$totalCost', '$discount', '$orderDay', '$orderMonth', '$orderYear', '$finalHour')";

                                        $result = $this->query($sql);

                                        if (is_array($result)) {
                            
                                            return $result;
                                
                                        }

                                    }

                                    break;

                                default:
                                
                                    break;
                                    
                            }

                        }
                    }
                }
            }
        }

        public function updateOrders($orderService, $body) {

            $fields = [];

            foreach($body as $key => $value) {
                $fields[] = "{$key} = '{$value}'";
            }
            
            $fields = implode(', ', $fields);

            $sql = "UPDATE {$this->table} SET {$fields} WHERE orderService = '{$orderService}'";
            
            return $this->query($sql);

        }

        public function findOrders($query) {

            $sql = "SELECT * FROM {$this->table} WHERE ";
            
            foreach ($query as $column => $value) {  

                $sql = $sql . "{$column} = '{$value}' AND ";
                
            }
            
            $sql = substr($sql, 0, -5);

            $response = $this->query($sql);

            if (!is_array($response)) {
                                
                return $response->get();

            } else {
                
                return $response;

            }

        }

        public function fixOrders($ordersArray) {

            $finalArray = [];

                // $licensePlates = array_values(array_unique(array_column($result, 'carId')));

                $previousLicense = null;

                $previousService = null;

                $previousOrder = null;

                $contadorVehiculos = -1;
                
                foreach ($ordersArray as $service) {

                    $currentLicense = $service['carId'];

                    $currentService = $service['serviceId'];

                    $currentWorker = $service['workerId'];

                    $currentOrder = $service['orderService'];

                    if ($currentLicense != $previousLicense) {
                        
                        $contadorVehiculos = $contadorVehiculos + 1;
                        
                        $contadorServicios = -1;

                        $contadorServicios = $contadorServicios + 1;

                        $vehicleResult = $this->whereTable('*', 'cars', 'licensePlate', $currentLicense);

                        if (!is_array($vehicleResult)) {
                
                            $vehicleResult = $vehicleResult->first();
                
                        } else {
                
                            return $vehicleResult;

                        }
                        
                        $finalArray[] = $vehicleResult;
                        
                        $finalArray[$contadorVehiculos]['services'] = array();
                        

                        $serviceResult = $this->whereTable('serviceName, cost, discountDay', 'services', 'id', $currentService);

                        if (!is_array($serviceResult)) {
                
                            $serviceResult = $serviceResult->first();
                
                        } else {
                
                            return $serviceResult;

                        }

                        $finalArray[$contadorVehiculos]['services'][] = $serviceResult;
                        
                        $finalArray[$contadorVehiculos]['services'][$contadorServicios]['orderService'] = $currentOrder;
                        
                        $finalArray[$contadorVehiculos]['services'][0]['workers'] = array();
                        

                        $workerResult = $this->whereTable('name', 'workers', 'rut_passport', $currentWorker);

                        if (!is_array($workerResult)) {
                
                            $workerResult = array_values($workerResult->first());
                
                        } else {
                
                            return $workerResult;

                        }
                        
                        $finalArray[$contadorVehiculos]['services'][0]['workers'] = $workerResult;
                        

                        $serviceDate = $service['orderDay'] . '-' . $service['orderMonth'] . '-' . $service['orderYear'] . ' ' . $service['orderHour'];

                        $finalArray[$contadorVehiculos]['services'][0]['date'] = $serviceDate;


                        $previousLicense = $currentLicense;

                        $previousService = $currentService;

                    } else {

                        if ($currentService != $previousService || $currentOrder != $previousOrder) {

                            $contadorServicios = $contadorServicios + 1;

                            $serviceResult = $this->whereTable('serviceName, cost, discountDay', 'services', 'id', $currentService);

                            if (!is_array($serviceResult)) {
                    
                                $serviceResult = $serviceResult->first();
                    
                            } else {
                    
                                return $serviceResult;
    
                            }

                            array_push($finalArray[$contadorVehiculos]['services'], $serviceResult);

                            $finalArray[$contadorVehiculos]['services'][$contadorServicios]['orderService'] = $currentOrder;
        
                            $finalArray[$contadorVehiculos]['services'][$contadorServicios]['workers'] = array();


                            $workerResult = $this->whereTable('name', 'workers', 'rut_passport', $currentWorker);

                            if (!is_array($workerResult)) {
                    
                                $workerResult = array_values($workerResult->first());
                    
                            } else {
                    
                                return $workerResult;
    
                            }
    
                            $finalArray[$contadorVehiculos]['services'][$contadorServicios]['workers'] = $workerResult;


                            $serviceDate = $service['orderDay'] . '-' . $service['orderMonth'] . '-' . $service['orderYear'] . ' ' . $service['orderHour'];

                            $finalArray[$contadorVehiculos]['services'][$contadorServicios]['date'] = $serviceDate;


                            $previousService = $currentService;

                        } else {

                            $workerResult = $this->whereTable('name', 'workers', 'rut_passport', $currentWorker);

                            if (!is_array($workerResult)) {
                    
                                $workerResult = array_values($workerResult->first());
                    
                            } else {
                    
                                return $workerResult;
    
                            }

                            array_push($finalArray[$contadorVehiculos]['services'][$contadorServicios]['workers'], $workerResult[0]);

                        }

                    }

                    $previousOrder = $currentOrder;
                        
                }

                return $finalArray;
        }
        
    }

?>

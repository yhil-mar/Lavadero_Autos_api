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
                                    $sqlService = "SELECT cost FROM services WHERE id = {$idService}";
                                    $arregloCosto = $this->query($sqlService)->first();
                                    $costo = $arregloCosto['cost'];

                                    $fraccion = ceil($costo / $amountWorkers); // preguntar cuantos decimales dejar
                                    
                                    foreach($elemValue as $idWorker) {

                                        $sql = "INSERT INTO {$this->table} (orderService, carId, serviceId, workerId, fractionalCost, totalCost, orderDay, orderMonth, orderYear, orderHour)
                                            VALUES ('$orderService', '$idVehicle', '$idService', '$idWorker', '$fraccion', '$costo', '$orderDay', '$orderMonth', '$orderYear', '$finalHour')";

                                        $this->query($sql);
                                    }

                                    break;

                                default:
                                    break;
                            }

                        }
                    }
                }
            }

            return ['status' => 'Information uploaded'];

        }

        public function updateOrders($orderService, $body) {

            $fields = [];

            foreach($body as $key => $value) {
                $fields[] = "{$key} = '{$value}'";
            }
            
            $fields = implode(', ', $fields);

            $sql = "UPDATE {$this->table} SET {$fields} WHERE orderService = '{$orderService}'";
            
            $this->query($sql);

            return ["status" => "updated"];

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

                        $sql = "SELECT * FROM cars WHERE licensePlate = '$currentLicense'";
                        
                        $vehicleResult = $this->query($sql);
                        
                        $vehicleResult = $vehicleResult->first();
                        
                        $finalArray[] = $vehicleResult;
                        
                        $finalArray[$contadorVehiculos]['services'] = array();
                        

                        $sql = "SELECT serviceName, cost FROM services WHERE id = '$currentService'";

                        $serviceResult = $this->query($sql);
                        
                        $serviceResult = $serviceResult->first();

                        $finalArray[$contadorVehiculos]['services'][] = $serviceResult;
                        
                        $finalArray[$contadorVehiculos]['services'][$contadorServicios]['orderService'] = $currentOrder;
                        
                        $finalArray[$contadorVehiculos]['services'][0]['workers'] = array();
                        
                        
                        $sql = "SELECT name FROM workers WHERE rut_passport = '$currentWorker'";
                        
                        $workerResult = $this->query($sql);
                        
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

                            $serviceResult = $this->query($sql);
                                    
                            $serviceResult = $serviceResult->first();

                            array_push($finalArray[$contadorVehiculos]['services'], $serviceResult);

                            $finalArray[$contadorVehiculos]['services'][$contadorServicios]['orderService'] = $currentOrder;
        
                            $finalArray[$contadorVehiculos]['services'][$contadorServicios]['workers'] = array();


                            $sql = "SELECT name FROM workers WHERE rut_passport = '$currentWorker'";

                            $workerResult = $this->query($sql);
                                    
                            $workerResult = array_values($workerResult->first());
    
                            $finalArray[$contadorVehiculos]['services'][$contadorServicios]['workers'] = $workerResult;


                            $serviceDate = $service['orderDay'] . '-' . $service['orderMonth'] . '-' . $service['orderYear'] . ' ' . $service['orderHour'];

                            $finalArray[$contadorVehiculos]['services'][$contadorServicios]['date'] = $serviceDate;


                            $previousService = $currentService;

                        } else {

                            $sql = "SELECT name FROM workers WHERE rut_passport = '$currentWorker'";

                            $workerResult = $this->query($sql);
                                    
                            $workerResult = array_values($workerResult->first());

                            array_push($finalArray[$contadorVehiculos]['services'][$contadorServicios]['workers'], $workerResult[0]);

                        }

                    }

                    $previousOrder = $currentOrder;
                        
                }

                return $finalArray;
        }
        
    }

?>

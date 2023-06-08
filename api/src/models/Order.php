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

                                    $date = $elemValue;
                                    $orderService = $idVehicle . $date . $idService;
                                    
                                    break;
                                
                                case 'workers':

                                    $amountWorkers = count($elemValue);
                                    $sqlService = "SELECT cost FROM services WHERE id = {$idService}";
                                    $arregloCosto = $this->query($sqlService)->first();
                                    $costo = $arregloCosto['cost'];

                                    $fraccion = ceil($costo / $amountWorkers); // preguntar cuantos decimales dejar
                                    
                                    foreach($elemValue as $idWorker) {

                                        $sql = "INSERT INTO {$this->table} (orderService, carId, serviceId, workerId, fractionalCost, totalCost, orderDate)
                                            VALUES ('$orderService', '$idVehicle', '$idService', '$idWorker', '$fraccion', '$costo', '$date')";

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

            echo('Información cargada');

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
        
    }

?>

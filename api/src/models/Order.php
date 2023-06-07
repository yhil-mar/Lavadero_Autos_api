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
                                    $orderService = $idVehicle . '-' . $date;
                                    
                                    break;
                                
                                case 'workers':

                                    $amountWorkers = count($elemValue);
                                    $sqlService = "SELECT costo FROM services WHERE id = {$idService}";
                                    $arregloCosto = $this->query($sqlService)->first();
                                    $costo = $arregloCosto['costo'];

                                    $fraccion = ceil($costo / $amountWorkers); // preguntar cuantos decimales dejar
                                    
                                    foreach($elemValue as $idWorker) {

                                        $sql = "INSERT INTO {$this->table} (order_service, car_id, service_id, worker_id, fractional_cost, total_cost, order_date) VALUES ('$orderService', '$idVehicle', '$idService', '$idWorker', '$fraccion', '$costo', '$date')";
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
        
    }

?>

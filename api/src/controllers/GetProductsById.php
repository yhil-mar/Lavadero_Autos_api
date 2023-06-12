<?php

    namespace Src\Controllers;

    use Src\Models\Product;

    class GetProductsById {
        
        public function getProductsById ($id) {

            $productModel = new Product();

            $response = $productModel->where("id", $id);

            if (!is_array($response)) {
                
                $response = $response->first();

                if ($response) {

                    return $response;
    
                } else {
    
                    return ['status' => 'No results found'];
    
                }                                

            } else {
                
                return $response;

            }
            
        }
    }

?>
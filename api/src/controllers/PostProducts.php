<?php

    namespace Src\Controllers;

    use Src\Models\Product;

    class PostProducts {
        
        public function postProducts($body) {

            $productModel = new Product();

            $result = $productModel->create($body);

            if (!is_array($result)) {
                
                return ["status" => "created"];
                
            } else {
                
                return $result;

            }
            
        }
    }

?>
<?php

    namespace Src\Controllers;

    use Src\Models\Product;

    class PostProducts {
        
        public function postProducts($body) {

            $productModel = new Product();

            return $productModel->create($body);
            
        }
    }

?>
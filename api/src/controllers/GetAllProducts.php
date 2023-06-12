<?php

    namespace Src\Controllers;

    use Src\Models\Product;

    class GetAllProducts {
        
        public function getAllProducts() {

            $productModel = new Product();

            return $productModel->all();
            
        }
    }

?>
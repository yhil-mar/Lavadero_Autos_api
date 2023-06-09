<?php

    namespace Src\Controllers;

    use Src\Models\Product;

    class PutProducts {
        
        public function putProducts($id, $data) {

            $productModel = new Product();

            return $productModel->update($id ,$data);
            
        }

    }

?>
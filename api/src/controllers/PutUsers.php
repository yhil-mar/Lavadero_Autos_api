<?php

    namespace Src\Controllers;

    use Src\Models\User;

    class PutUsers {
        
        public function putUsers($id, $data) {

            $userModel = new User();

            return $userModel->update($id ,$data);
            
        }

    }

?>
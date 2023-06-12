<?php

    namespace Src\Controllers;

    use Src\Models\User;

    class GetAllUsers {
        
        public function getAllUsers() {

            $userModel = new User();

            return $userModel->all();
            
        }
    }

?>
<?php

    namespace Src\Controllers;

    use Src\Models\User;

    class PostUsers {
        
        public function postUsers($body) {

            $userModel = new User();

            $result = $userModel->create($body);

            if (!is_array($result)) {
                
                return ["status" => "created"];
                
            } else {
                
                return $result;

            }
        }
    }

?>
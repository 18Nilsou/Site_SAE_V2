<?php

final class RecievepasswordController{
    
    public function defaultAction(): void{
        View::show("recievepassword/form");
    }

    public function steptwoAction(Array $A_parametres = null, Array $A_postParams = null): void{
        if(Users::checkIfExistsByEmail($A_postParams['id'])){  
            $I_token = Recievepassword::genToken();
            Recievepassword::sendMail($A_postParams['id'], $I_token);
            View::show("recievepassword/newpassword");
        }
        else{
            header("location: /recievepassword");
        }
    }

    public function newpasswordAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        if(Recievepassword::checkToken($A_postParams['token'], $A_postParams['email'])){
            unset($A_postParams['token']);
            $A_user = Users::selectByEmail($A_postParams['email']);
            $S_id = $A_user['id'];
            unset($A_user);
            $A_postParams['password'] = hash('sha512', $A_postParams['password']);
            Users::updateById($A_postParams, $S_id);
            Recievepassword::deleteByID($A_postParams['email']);
            header("location: /signin");
        }else{
            View::show("recievepassword/newpassword");
        }
    }
}
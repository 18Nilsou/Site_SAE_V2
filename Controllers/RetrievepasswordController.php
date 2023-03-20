<?php

final class RetrievepasswordController{
    
    public function defaultAction(): void{
        View::show("retrievepassword/form");
    }

    public function steptwoAction(Array $A_parametres = null, Array $A_postParams = null): void{
        $A_user = Users::selectByEmail($A_postParams['email']);
        if(isset($A_user)){  
            $I_token = Retrievepassword::genToken();
            Retrievepassword::sendMail($A_user, $I_token);
            View::show("retrievepassword/newpassword");
        }
        else{
            header("location: /retrievepassword");
        }
    }

    public function newpasswordAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        $A_user = Users::selectByEmail($A_postParams['email']);
        if(Retrievepassword::checkToken($A_postParams['token'], $A_user['id'])){
            unset($A_postParams['token']);
            $S_id = $A_user['id'];
            unset($A_user);
            $A_postParams['password'] = hash('sha512', $A_postParams['password'].$S_id);
            Users::updateById($A_postParams, $S_id);
            Retrievepassword::deleteByID($A_postParams['email']);
            header("location: /signin");
        }else{
            View::show("retrievepassword/newpassword");
        }
    }
}
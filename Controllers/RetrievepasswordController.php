<?php

/**
 * Class RetrievepasswordController
 *
 * This class handles the logic for resetting a user's password.
 */
final class RetrievepasswordController{

    /**
     * defaultAction
     *
     * Displays the form for resetting a password.
     */
    public function defaultAction(): void{
        View::show("retrievepassword/form");
    }

    /**
     * steptwoAction
     *
     * Retrieves user info by email and sends a token to the user's email address.
     *
     * @param array|null $A_parametres - The request parameters
     * @param array|null $A_postParams - The post parameters
     */
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

    /**
     * newpasswordAction
     *
     * Updates the user's password based on the token provided.
     *
     * @param array|null $A_parametres - The request parameters
     * @param array|null $A_postParams - The post parameters
     */
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
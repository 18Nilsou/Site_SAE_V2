<?php

/**
 * Model class to interact with the DB table Retrievepassword
 *
 * @extends Model
 * @final
 */
final class Retrievepassword extends Model{

    /**
     * Send an email to the user containing a token
     *
     * @param array $A_user The array of the user
     * @param int $I_token The token to send
     *
     * @return void
     */
    public static function sendMail(array $A_user, int $I_token){
        $A_params['token'] = $I_token;
        $A_params['id'] = $A_user["id"];
        $A_params['creation_date'] = date("d-M-Y H:i");
        if(self::create($A_params)){
            $A_mailContent['subject'] = "Récuperation de mot de passe";
            $A_mailContent['body'] = "Voici votre token valable pendant 10min : ".$I_token;
            Mailer::sendMail($A_user["email"], $A_mailContent);
        }
    }

    /**
     * Generate a token
     *
     * @return int A random integer between 100000 and 999999
     */
    public static function genToken(){
        return rand(100000, 999999);
    }

    /**
     * Check the validity of a token
     *
     * @param int $I_token The token to check
     * @param string $S_id The user ID
     *
     * @return boolean True if the token is valid, false otherwise
     */
    public static function checkToken(int $I_token, string $S_id){
        $A_usertoken = self::selectById($S_id);
        if($A_usertoken['token'] == $I_token){
            $I_date = mktime(date("H"), date("i")-10, date("s"), date("m"), date("d"), date("Y"));
            $S_date = date("d-M-Y H:i",$I_date);
            if($S_date < $A_usertoken['creation_date']){
                return true;
            }
            self::deleteByID($S_id);
        }
        return false;
    }
}
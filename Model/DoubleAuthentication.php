<?php

/**
 * Model class to interact with the DB table DoubleAuthentication
 *
 * @extends Model
 * @final
 */
final class DoubleAuthentication extends Model{

    /**
     * Select one row in the DoubleAuthentication table with a token
     *
     * @param string $S_token Token used to select a row
     *
     * @return array
     */
    public static function selectByToken(string $S_token){
        $O_con = Connection::initConnection();
        $S_stmnt = "SELECT * FROM DoubleAuthentication WHERE token = :token ";
        $P_sth = $O_con->prepare($S_stmnt);
        $P_sth -> bindValue(":token", $S_token, PDO::PARAM_STR);
        $P_sth->execute();
        return $P_sth->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Send a mail to the user in order to double authenticate
     *
     * @param array $A_params Parameters used to send the mail
     *
     * @return bool
     */
    public static function sendmail($A_params){
        unset($A_params['password']);
        $A_params['token'] = self::genToken();
        $A_params['creation_date'] = date("d-M-Y H:i");
        $S_email = Users::selectById($A_params['id'])['email'];
        
        if(self::create($A_params)){
            $A_mailContent['subject'] = "Double Authentification - Find the breach";
            $A_mailContent['body'] = "Voici votre token, il valable pendant 10min :".$A_params['token'];
            Mailer::sendMail($S_email, $A_mailContent);
            return true;
        }
        return false;
    }

    /**
     * Generate a token
     *
     * @return int
     */
    public static function genToken(){
       return rand(100000, 999999);
    }

}
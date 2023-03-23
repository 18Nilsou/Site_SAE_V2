<?php

final class DoubleAuthentication extends Model{

    public static function selectByToken(string $S_token){
        $O_con = Connection::initConnection();
        $S_stmnt = "SELECT * FROM DoubleAuthentication WHERE token = :token ";
        $P_sth = $O_con->prepare($S_stmnt);
        $P_sth -> bindValue(":token", $S_token, PDO::PARAM_STR);
        $P_sth->execute();
        return $P_sth->fetch(PDO::FETCH_ASSOC);
    }

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

    public static function genToken(){
       return rand(100000, 999999);
    }

}
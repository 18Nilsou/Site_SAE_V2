<?php

final class Checkemail extends Model{

    public static function selectByToken(string $S_token){
        $O_con = Connection::initConnection();
        $S_stmnt = "SELECT * FROM checkemail WHERE token = :token ";
        $P_sth = $O_con->prepare($S_stmnt);
        $P_sth -> bindValue(":token", $S_token, PDO::PARAM_INT);
        $P_sth->execute();
        return $P_sth->fetch(PDO::FETCH_ASSOC);
    }
  
    public static function sendmail($S_id, $S_email){
        $A_params['token'] = self::genToken();
        $A_params['creation_date'] = date("d-M-Y H:i");
        $A_params['id'] = $S_id;
        if(self::create($A_params)){
            $A_mailContent['subject'] = "Vérification d'email";
            $A_mailContent['body'] = "Voici votre token valable pendant 10min : ".$A_params['token'];
            return Mailer::sendMail($S_email, $A_mailContent);
        }
        return false;
    }

    public static function genToken():int{
       return rand(100000, 999999);
    }

}
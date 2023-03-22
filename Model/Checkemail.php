<?php

final class Checkemail extends Model{

    public static function selectByToken(string $S_token){
        $O_con = Connection::initConnection();
        $S_stmnt = "SELECT * FROM checkemail WHERE token = :token ";
        $P_sth = $O_con->prepare($S_stmnt);
        $P_sth -> bindValue(":token", $S_token, PDO::PARAM_STR);
        $P_sth->execute();
        return $P_sth->fetch(PDO::FETCH_ASSOC);
    }

    public static function sendmail($A_params){
        $A_params['token'] = self::genToken($A_params['id']);
        $A_params['creation_date'] = date("d-M-Y H:i");
        $A_params['password'] = hash('sha512', $A_params['password'].$A_params['id']);
        if(self::create($A_params)){
            $A_mailContent['subject'] = "Vérification d'email";
            $A_mailContent['body'] = "Voici votre lien valable pendant 10min : 127.0.0.1/checkemail/steptwo/".$A_params['token'];
            Mailer::sendMail($A_params['email'], $A_mailContent);
        }
    }

    public static function genToken($S_id){
       return hash('sha512', rand(100000, 999999).$S_id);
    }

}
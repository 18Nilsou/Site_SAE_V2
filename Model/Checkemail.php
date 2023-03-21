<?php

final class Checkemail extends Model{

    public static function sendmail($S_mail, $S_id){
        $A_params['token'] = self::genToken();
        $A_params['id'] = $S_id;
        $A_params['creation_date'] = date("d-M-Y H:i");
        if(self::create($A_params)){
            $A_mailContent['subject'] = "Vérification d'email";
            $A_mailContent['body'] = "Voici votre token valable pendant 10min : ".$A_params['token'];
            Mailer::sendMail($S_mail, $A_mailContent);
        }
    }

    public static function genToken(){
        return rand(100000, 999999);
    }

}
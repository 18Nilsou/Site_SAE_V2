<?php
final class Retrievepassword extends Model{

    public static function sendMail(string $S_mail, int $I_token){
        $A_params['id'] = $S_mail;
        $A_params['token'] = $I_token;
        $A_params['creation_date'] = date("Y-m-d H:i:s");
        if(self::create($A_params)){
            $A_mailContent['subject'] = "Récuperation de mot de passe";
            $A_mailContent['body'] = "Voici votre token valable pendant 10min : ".$I_token;
            Mailer::sendMail($S_mail, $A_mailContent);
        }
    }

    public static function genToken(){
        return rand(100000, 999999);
    }

    public static function checkToken(int $I_token, string $S_id){
        $A_user = self::selectById($S_id);
        if($A_user['token'] == $I_token){
            $I_date = mktime(date("H"), date("i")-10, date("s"), date("m"), date("d"), date("Y"));
            $S_date = date("Y-m-d H:i:s",$I_date);
            if($S_date < $A_user['date']){
                return true;
            }
            self::deleteByID($S_id);
        }
        return false;
    }


}
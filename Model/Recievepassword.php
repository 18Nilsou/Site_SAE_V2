<?php
final class Recievepassword extends Model{

    public static function sendMail(string $S_mail, int $I_token){
        $A_parms['id'] = $S_mail;
        $A_parms['token'] = $I_token;
        $A_parms['date'] = date("Y-m-d H:i:s");
        if(self::create( $A_parms)){
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
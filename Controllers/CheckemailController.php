<?php

final class CheckemailController{

    public function defaultAction(Array $A_parametres = null, Array $A_postParams = null): void{
        if(!Users::checkIfExistsByEmail($A_postParams['email'])){
            Checkemail::sendMail($A_postParams);
        }
        header("location: /signup");
        exit;
    }

    public function steptwoAction(Array $A_parametres = null, Array $A_postParams = null){
        $A_checkemail = Checkemail::selectByToken($A_parametres[0]);
        $I_date = mktime(date("H"), date("i")-10, date("s"), date("m"), date("d"), date("Y"));
        $S_date = date("d-M-Y H:i",$I_date);
        if ($A_parametres[0] == $A_checkemail['token'] && $A_checkemail['creation_date'] < $S_date){
            unset($A_checkemail['token']);
            unset($A_checkemail['creation_date']);
            if(Users::create($A_checkemail)){
                Checkemail::deleteByID($A_checkemail["id"]);
                Session::start('user', $A_checkemail['id']);
                header('Location: /home');
                exit;
            }
        }
        header("location: /signup");
        exit;
    }
}
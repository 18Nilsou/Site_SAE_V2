<?php

final class CheckemailController{

    public function defaultAction(Array $A_parametres = null, Array $A_postParams = null): void{
        if(!Users::checkIfExistsByEmail($A_postParams['email'])){
            Checkemail::sendMail($A_postParams['email'], $A_postParams['id']);
            View::show("checkemail/form", $A_postParams);
        }
        header("location: /signup");
        exit;
    }

    public function steptwoAction(Array $A_parametres = null, Array $A_postParams = null){
        $A_checkemail = Checkemail::selectById($A_postParams["id"]);
        $I_date = mktime(date("H"), date("i")-10, date("s"), date("m"), date("d"), date("Y"));
        $S_date = date("d-M-Y H:i",$I_date);
        if ($A_postParams['token'] == $A_checkemail['token'] && $A_checkemail['creation_date'] < $S_date){
            unset($A_postParams['token']);
            $A_postParams['password'] = hash('sha512', $A_postParams['password'].$A_postParams['id']);
            if(Users::create($A_postParams)){
                Checkemail::deleteByID($A_postParams["id"]);
                Session::start('user', $A_postParams['id']);
                header('Location: /home');
                exit;
            }
        }
        View::show("checkemail/form", $A_postParams);
    }
}
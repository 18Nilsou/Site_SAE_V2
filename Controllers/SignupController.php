<?php
final class SignupController{
    public function defaultAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        View::show("signup/form");
    }

    public function formErrorAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        View::show("signup/form", array('error' => 'Ce pseudo est déjà utilisé !'));
    }

    public function registerAction(Array $A_parametres = null, Array $A_postParams = null):void{
        $A_postParams['password'] = hash('sha512', $A_postParams['password'].$A_postParams['id']);

        if(!Users::checkIfExistsByEmail($A_postParams['email'])){
            if (!Users::checkIfExistsByEmail($A_postParams['id'])){
                header("location: /signup/formError");
                exit;
            }
            Checkemail::sendMail($A_postParams['id'], $A_postParams['email']);
            View::show("checkemail/form",$A_postParams);
        }else{
            header("location: /signup");
            exit;
        }
    }

    public function checkemailAction(Array $A_parametres = null, Array $A_postParams = null){

        $A_checkemail = Checkemail::selectById($A_postParams['id']);
        $I_date = mktime(date("H"), date("i")-10, date("s"), date("m"), date("d"), date("Y"));
        $S_date = date("d-M-Y H:i",$I_date);
        if ($A_postParams['token'] == $A_checkemail['token'] && $A_checkemail['creation_date'] < $S_date){
            unset($A_postParams['token']);
            var_dump($A_postParams);
            if(Users::create($A_postParams)){
                Checkemail::deleteByID($A_postParams['id']);
                Session::start('user', $A_postParams['id']);
                header('Location: /home');
                exit;
            }
        }
        View::show("checkemail/form",$A_postParams);
    }
}
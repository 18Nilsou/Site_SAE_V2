<?php
final class SignupController{
    public function defaultAction() : void{
        View::show("signup/form");
    }

    public function registerAction(Array $A_parametres = null, Array $A_postParams = null):void{
        $A_postParams['password'] = hash('sha512', $A_postParams['password']);
        if(Users::create($A_postParams)){
            Session::start('user', $A_postParams['id']);
            header('Location: /home');
            exit;
        }
        header('Location: /signin');
    }
}
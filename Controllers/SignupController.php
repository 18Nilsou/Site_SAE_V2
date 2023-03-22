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
        if (Users::checkIfExistsById($A_postParams['id'])) {
            header('Location: /signup/formError');
            exit;
        }
        if(Users::create($A_postParams)){
            Session::start('user', $A_postParams['id']);
            header('Location: /home');
            exit;
        }
        header('Location: /signin');
    }
}
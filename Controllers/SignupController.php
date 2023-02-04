<?php
final class SignupController{
    public function defaultAction() : void{
        View::show("signup/form");
    }

    public function registerAction(Array $A_parametres = null, Array $A_postParams = null):void{
        $A_postParams['password'] = hash('sha512', $A_postParams['password']);
        if(Users::create($A_postParams)){
            View::show("signin/form");
        }
    }
}
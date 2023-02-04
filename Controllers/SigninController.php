<?php
final class SigninController{

    public function defaultAction() : void{
        View::show("signin/form");
    }

    public function connectAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        var_dump($A_postParams);
        $S_status = Users::connect($A_postParams['id']);
        switch ($S_status) {
            case 'user':
            case 'admin':
                Session::start($S_status, $A_postParams['id']);
                header('Location: /home');
                break;
            default:
                View::show("/signin/form", $S_status);
        }
        
    }
}
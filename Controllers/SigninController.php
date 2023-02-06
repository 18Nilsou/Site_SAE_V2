<?php
final class SigninController{

    public function defaultAction() : void{
        View::show("signin/form");
    }

    public function connectAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        $S_status = Users::isUser($A_postParams);
        switch ($S_status) {
            case 'user':
            case 'admin':
                Session::start($S_status, $A_postParams['id']);
                header('Location: /home');
                break;
            default:
                header("Location: /signin");
        }
    }
}
<?php
final class SigninController{

    public function defaultAction() : void{
        View::show("signin/form");
    }

    public function connectAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        if(Users::isUser($A_postParams) != "Mot de passe ou Pseudo invalide" && DoubleAuthentication::sendMail($A_postParams)){
            View::show("2AF/form");
        }else{
            header("location: /signin");
            exit;
        }
    }


    public function twoauthAction(Array $A_parametres = null, Array $A_postParams = null){

        $A_checkemail = DoubleAuthentication::selectByToken($A_postParams['token']);

        $I_date = mktime(date("H"), date("i")-10, date("s"), date("m"), date("d"), date("Y"));
        $S_date = date("d-M-Y H:i",$I_date);

        if ($A_postParams['token'] == $A_checkemail['token'] && $A_checkemail['creation_date'] < $S_date){

            DoubleAuthentication::deleteByID($A_postParams['id']);
            $S_status = Users::getStatus($A_postParams['id']);
            switch ($S_status) {
                case 'user':
                case 'admin':
                    Session::start($S_status, $A_postParams['id']);
                    header('Location: /home');
                    break;
                default:
                    header("Location: /signin");
                    exit;
            }
        }
    }
}
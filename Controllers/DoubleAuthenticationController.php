<?php

final class DoubleAuthenticationController{

    public function defaultAction(Array $A_parametres = null, Array $A_postParams = null): void{
        if(Users::isUser($A_postParams)){
            unset($A_postParams['password']);
            DoubleAuthentication::sendMail($A_postParams);
            View::show("2AF/page", );
        }else{
            header("location: /signin");
            exit;
        }
    }

    public function steptwoAction(Array $A_parametres = null, Array $A_postParams = null){

        $A_checkemail =  DoubleAuthentication::selectByToken($A_parametres[0]);

        $I_date = mktime(date("H"), date("i")-10, date("s"), date("m"), date("d"), date("Y"));
        $S_date = date("d-M-Y H:i",$I_date);

        if ($A_parametres[0] == $A_checkemail['token'] && $A_checkemail['creation_date'] < $S_date){

            DoubleAuthentication::deleteByID($A_parametres[1]);
            $S_status = Users::getStatus($A_parametres[1]);
            switch ($S_status) {
                case 'user':
                case 'admin':
                    Session::start($S_status, $A_parametres[1]);
                    header('Location: /home');
                    break;
                default:
                    header("Location: /signin");
                    exit;
            }
        }
    }

}
<?php
/**
 * SigninController
 *
 * This class is responsible for handling the signin process.
 * It contains two public methods: `defaultAction` and `connectAction`,
 * and one private method `twoauthAction`.
 *
 * @author
 */
final class SigninController{

    /**
     * defaultAction
     *
     * This method is responsible for displaying the signin form.
     *
     * @return void
     */
    public function defaultAction() : void{
        View::show("signin/form");
    }

    /**
     * connectAction
     *
     * This method is responsible for checking the user's credentials
     * and sending a confirmation email if they are valid.
     *
     * @param Array $A_parametres
     * @param Array $A_postParams
     *
     * @return void
     */
    public function connectAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        if(Users::isUser($A_postParams) != "Mot de passe ou Pseudo invalide" && DoubleAuthentication::sendMail($A_postParams)){
            View::show("2AF/form");
        }else{
            header("location: /signin");
            exit;
        }
    }

    /**
     * twoauthAction
     *
     * This method is responsible for checking the confirmation email
     * and if it has been sent within the last 10 minutes.
     * If the confirmation is valid, the user is logged in.
     *
     * @param Array $A_parametres
     * @param Array $A_postParams
     *
     * @return void
     */
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
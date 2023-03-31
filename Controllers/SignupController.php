<?php
/**
 * SignupController
 *
 * This class contains the default, formError, register and checkemail actions
 * for the signup controller
 */
final class SignupController{

    /**
     * defaultAction
     *
     * This method shows the signup/form view
     *
     * @param Array $A_parametres The parameters array
     * @param Array $A_postParams The post parameters array
     * @return void
     */
    public function defaultAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        View::show("signup/form");
    }

    /**
     * formErrorAction
     *
     * This method shows the signup/form view with an error
     *
     * @param Array $A_parametres The parameters array
     * @param Array $A_postParams The post parameters array
     * @return void
     */
    public function formErrorAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        View::show("signup/form", array('error' => 'This username already exists !'));
    }

    /**
     * registerAction
     *
     * This method encrypts the password, checks if the email already exists and shows the checkemail/form view
     *
     * @param Array $A_parametres The parameters array
     * @param Array $A_postParams The post parameters array
     * @return void
     */
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

    /**
     * checkemailAction
     *
     * This method checks if the token is valid and the creation date of it, and if all is correct, creates a user and starts a session, redirecting to the home page
     *
     * @param Array $A_parametres The parameters array
     * @param Array $A_postParams The post parameters array
     * @return void
     */
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
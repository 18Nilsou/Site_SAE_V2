<?php

/**
 * UserController
 * This class is responsible for handle all the user controller requests.
 */
final class UserController{
    /**
     * defaultAction
     * This method handles the default user controller request.
     * If the session is set, the view will show the users profile, score and feed-back.
     */
    public function defaultAction(): void{
        if(Session::getSession()){
            View::show("user/profil", Users::selectById(Session::getSession()['id']));
            View::show("user/score", Users::selectMyScore(Session::getSession()['id']));
            View::show("user/feed-back", Users::selectMyFeedBack(Session::getSession()['id']));
        }
    }

    /**
     * addfeedbackAction
     * This method handles the add feedback controller request.
     * The view will show the form for adding feedback.
     *
     * @param array|null $A_parametres
     * @param array|null $A_postParams
     */
    public function addfeedbackAction(Array $A_parametres = null, Array $A_postParams = null){
        View::show("feedback/add",$A_postParams);
    }
}
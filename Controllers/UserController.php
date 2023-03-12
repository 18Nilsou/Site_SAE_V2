<?php

final class UserController{
    public function defaultAction(): void{
        if(Session::getSession()){
            View::show("User/profile", Users::selectById(Session::getSession()['id']));
            View::show("User/score", Users::selectMyScore(Session::getSession()['id']));
            View::show("User/feed-back", Users::selectMyFeedBack(Session::getSession()['id']));
        }
    }

    public function addfeedbackAction(Array $A_parametres = null, Array $A_postParams = null){
        View::show("feedback/add",$A_postParams);
    }
}
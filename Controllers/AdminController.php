<?php

final class AdminController
{
    public function defaultAction(): void
    {
        if(Session::getSession()['status'] != 'admin') {
            header("Location: /home");
            exit;
        }

        $A_questions = array ("trainning" => Questions::getQuestionArray("A1B2C3"), "play" => Questions::getQuestionArray("D4E5F6"));

        View::show("admin/admin-nav");
        View::show("admin/solo", $A_questions);
    }

    public function multiplayerAction(): void
    {
        if(Session::getSession()['status'] != 'admin') {
            header("Location: /home");
            exit;
        }
        View::show("admin/admin-nav");
        View::show("admin/multiplayer");
    }

    public function usersAction(): void
    {
        if(Session::getSession()['status'] != 'admin') {
            header("Location: /home");
            exit;
        }
        View::show("admin/admin-nav");
        View::show("admin/users");
    }

    public function modifyOrDeleteQuestionAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        Questions::form($A_postParams);
        header("location: /Admin");
    }

    public function addQuestionAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        Questions::add($A_postParams);
        header("location: /Admin");
    }
    
}
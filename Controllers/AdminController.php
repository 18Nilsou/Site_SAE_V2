<?php

final class AdminController
{
    public function defaultAction(): void
    {
        if(Session::getSession()['status'] != 'admin') {
            header("Location: /home");
            exit;
        }

        $A_questions = array ("training" => Questions::getQuestionArray("practice"), "play" => Questions::getQuestionArray("game"));

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

    public function addAdminAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        Admins::create($A_postParams);
        header("location: /Admin/users");
    }

    public function deleteAdminAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        Admins::deleteByID($A_postParams['id']);
        header("location: /Admin/users");
    }

    public function deleteUserAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        Admins::deleteByID($A_postParams['id']);
        Users::deleteByID($A_postParams['id']);
        header("location: /Admin/users");
    }

    public function getScoreAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        Files::score(Rooms::getScore($A_postParams));
        Files::download("score.txt","Files/score.txt");
    }
    
}
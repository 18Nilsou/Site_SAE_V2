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
        View::show("admin/multiplayer", Rooms::selectRoomsByAdmin(Session::getSession()['id']));
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

    public function createroomAction(Array $A_parametres = null, Array $A_postParams = null): void
    {
        if(Session::getSession()['status'] != 'admin') {
            header("Location: /home");
            exit;
        }
        $A_postParams['id'] = Rooms::uniqueId();
        $A_postParams['started'] = 'false';
        $A_postParams['admin_id'] = Session::getSession()['id'];
        Rooms::create($A_postParams);
        header('Location: /admin/multiplayer');
    }

    public function deleteroombyidAction(Array $A_parametres = null, Array $A_postParams = null):void {
        if (Rooms::selectById($A_parametres[0])['admin_id'] == Session::getSession()['id']) {
            Rooms::deleteByID($A_parametres[0]);
        }
        header('Location: /admin/multiplayer');
        exit;
    }

    public function changeroomstatusAction(Array $A_parametres = null, Array $A_postParams = null):void {
        $A_room = Rooms::selectById($A_parametres[0]);
        if ($A_room['admin_id'] == Session::getSession()['id']) {
            if ($A_room['started']) {
                $A_room['started'] = 'false';
                Rooms::updateById($A_room, $A_parametres[0]);
            } else {
                $A_room['started'] = 'true';
                Rooms::updateById($A_room, $A_parametres[0]);
            }
        }
        header('Location: /admin/multiplayer');
        exit;
    }

    public function modifyOrDeleteQuestionAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        Questions::form($A_postParams);
        header("location: /admin");
    }

    public function addQuestionAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        Questions::add($A_postParams);
        header("location: /admin");
    }

    public function addAdminAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        Admins::create($A_postParams);
        header("location: /admin/users");
    }

    public function deleteAdminAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        Admins::deleteByID($A_postParams['id']);
        header("location: /admin/users");
    }

    public function deleteUserAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        Admins::deleteByID($A_postParams['id']);
        Users::deleteByID($A_postParams['id']);
        header("location: /admin/users");
    }

    public function getScoreAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        Files::score(Rooms::getScore($A_postParams));
        Files::download("score.txt","Files/score.txt");
    }
}
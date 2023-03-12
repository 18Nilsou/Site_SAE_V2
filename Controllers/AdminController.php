<?php

final class AdminController
{
    public function defaultAction(): void
    {
        if(Session::getSession()['status'] != 'admin') {
            header("Location: /home");
            exit;
        }

        $A_questions = array ("training" => Questions::getQuestionArray("practice", "Admin/modifyOrDeleteQuestion"), "play" => Questions::getQuestionArray("game","Admin/modifyOrDeleteQuestion"));

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
            } else {
                $A_room['started'] = 'true';
            }
            Rooms::updateById($A_room, $A_parametres[0]);
        }
        header('Location: /admin/multiplayer');
        exit;
    }

    public function modifyroomAction(Array $A_parametres = null, Array $A_postParams = null) {
        $A_room = Rooms::selectById($A_parametres[0]);
        if ($A_room['admin_id'] != Session::getSession()['id']) {
            header('Location: /admin/multiplayer');
            exit;
        }
        View::show("admin/admin-nav");
        View::show("admin/modifyroom", array('room' => $A_room, 'questions' => Questions::getQuestionArray($A_parametres[0], "/admin/modifyOrDeleteQuestionRoom")));
    }

    public function inviteusersAction($A_parametres = null, Array $A_postParams = null) {
        $A_room = Rooms::selectById($A_postParams['roomId']);
        $A_users = explode(',',$A_postParams['userList']);
        $A_inviteMessageContent = array('subject' => 'Invitation dans un salon de jeu Find the breach',
            'body' => 'Vous avez été invité à rejoindre une salle de Jeu sur FindTheBreach ! 
            Le nom de la salle est : '. $A_room['name'] . ' et son code pour la rejoindre est : ' .
            $A_room['id'] . ' À très vite !',);
        foreach ($A_users as $S_UserMail) {
            Mailer::sendMail($S_UserMail, $A_inviteMessageContent);
        }
        header('Location: /admin/modifyroom/'. $A_room['id']);
        exit;
    }

    public function modifyOrDeleteQuestionAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        if (!Session::isAdmin()) {
            header("location: /signin");
        }
        Questions::form($A_postParams);
        header("location: /admin");
    }

    public function modifyOrDeleteQuestionRoomAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        $A_room = Rooms::selectById($A_postParams['room_id']);
        if ($A_room['admin_id'] != Session::getSession()['id']) {
            header('Location: /admin/multiplayer');
            exit;
        }
        Questions::form($A_postParams);
        header('Location: /admin/modifyroom/'. $A_room['id']);
        exit;
    }

    public function addQuestionAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        if (!Session::isAdmin()) {
            header("location: /signin");
            exit;
        }
        Questions::add($A_postParams);
        header("location: /admin");
    }

    public function addRoomQuestionAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        $A_room = Rooms::selectById($A_postParams['room_id']);
        if ($A_room['admin_id'] != Session::getSession()['id']) {
            header('Location: /admin/multiplayer');
            exit;
        }
        Questions::add($A_postParams);
        header('Location: /admin/modifyroom/'. $A_room['id']);
        exit;
    }

    public function addAdminAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        if (!Session::isAdmin()) {
            header("location: /signin");
            exit;
        }
        Admins::create($A_postParams);
        header("location: /admin/users");
    }

    public function deleteAdminAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        if (!Session::isAdmin()) {
            header("location: /signin");
            exit;
        }
        Admins::deleteByID($A_postParams['id']);
        header("location: /admin/users");
    }

    public function deleteUserAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        if (!Session::isAdmin()) {
            header("location: /signin");
            exit;
        }
        Admins::deleteByID($A_postParams['id']);
        Users::deleteByID($A_postParams['id']);
        header("location: /admin/users");
    }

    public function getScoreAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        if (!Session::isAdmin()) {
            header("location: /signin");
            exit;
        }
        Files::score(Rooms::getScore($A_postParams));
        Files::download("score.txt","Files/score.txt");
    }
}
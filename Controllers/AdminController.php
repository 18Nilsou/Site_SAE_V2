<?php

/**
 * Class AdminController used to manage the admin page
 * @package Controllers
 */
final class AdminController
{
    /**
     * Redirects the user to the home page if the status of the session is not "admin",
     * else shows the admin page with the list of questions for solo part
     * @return void
     */
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

    /**
     *
     * Redirects to the home page if the user is not an admin,
     * else shows the admin multiplayer page with the list of rooms and create rooms form
     *
     * @return void
     */
    public function multiplayerAction(): void
    {
        if(Session::getSession()['status'] != 'admin') {
            header("Location: /home");
            exit;
        }
        View::show("admin/admin-nav");
        View::show("admin/multiplayer", Rooms::selectRoomsByAdmin(Session::getSession()['id']));
    }

    /**
     * Redirects to the home page if the user is not an admin,
     * else shows the users management page
     *
     * @return void
     */
    public function usersAction(): void
    {
        if(Session::getSession()['status'] != 'admin') {
            header("Location: /home");
            exit;
        }
        View::show("admin/admin-nav");
        View::show("admin/users");
    }

    /**
     * Redirects to the home page if the user is not an admin,
     * else creates a room with the parameters given in the form
     *
     * @param array|null $A_parametres
     * @param array|null $A_postParams
     * @return void
     */
    public function createroomAction(Array $A_parametres = null, Array $A_postParams = null): void
    {
        if(Session::getSession()['status'] != 'admin') {
            header("Location: /home");
            exit;
        }
        $A_postParams['id'] = Rooms::uniqueId();
        $A_postParams['admin_id'] = Session::getSession()['id'];
        Rooms::create($A_postParams);
        header('Location: /admin/multiplayer');
    }

    /**
     * Redirects to the home page if the user is not the admin of the room,
     * else deletes the room with the given id
     *
     * @param array|null $A_parametres
     * @param array|null $A_postParams
     * @return void
     */
    public function deleteroombyidAction(Array $A_parametres = null, Array $A_postParams = null):void {
        if (Rooms::selectById($A_parametres[0])['admin_id'] == Session::getSession()['id']) {
            Scores::deleteByRoom($A_parametres[0]);
            Whitelist::deleteByRoom($A_parametres[0]);
            Questions::deleteByRoom($A_parametres[0]);
            Rooms::deleteByID($A_parametres[0]);
        }
        header('Location: /admin/multiplayer');
        exit;
    }

    /**
     * Redirects to the home page if the user is not the admin of the room,
     * else shows the modify room page with the room's information and the list of questions
     *
     * @param array|null $A_parametres
     * @param array|null $A_postParams
     * @return void
     */
    public function modifyroomAction(Array $A_parametres = null, Array $A_postParams = null): void
    {
        $A_room = Rooms::selectById($A_parametres[0]);
        if ($A_room['admin_id'] != Session::getSession()['id']) {
            header('Location: /home');
            exit;
        }
        View::show("admin/admin-nav");
        $A_guests = Whitelist::selectByRoom($A_parametres[0]);
        $A_guestUsers = array();
        foreach ($A_guests as $A_guest) {
            $A_guestUsers[] = Users::selectById($A_guest['user_id']);
        }


        $A_feeback = Feedback::selectByRoom($A_room['id']);
        $A_topFive = Scores::topFive($A_room['id']);

       
        $A_paramForView['room'] = $A_room;
        $A_paramForView['questions'] = Questions::getQuestionArray($A_parametres[0], "/admin/modifyOrDeleteQuestionRoom");
        $A_paramForView['guestUsers'] = $A_guestUsers;

        if(isset($A_parametres[1])){
            $A_paramForView['unSignedUsers'] = $A_parametres[1];
        }
        if(isset($A_feeback)){
            $A_paramForView['feedback'] = $A_feeback;
        }
        if(isset($A_topFive)){
            $A_paramForView['topFive'] = $A_topFive;
        }
        View::show("admin/modifyroom", $A_paramForView);

        /*
        if (isset($A_parametres[1])) {
            View::show("admin/modifyroom", array('room' => $A_room,
                'questions' => Questions::getQuestionArray($A_parametres[0], "/admin/modifyOrDeleteQuestionRoom"),
                'guestUsers' => $A_guestUsers, 'unSignedUsers' => $A_parametres[1]));
        } else {
            View::show("admin/modifyroom", array('room' => $A_room,
                'questions' => Questions::getQuestionArray($A_parametres[0], "/admin/modifyOrDeleteQuestionRoom"),
                'guestUsers' => $A_guestUsers));
        }*/
    }

    /**
     * Redirects to the home page if the user is not the admin of the room,
     * else modifies the room with the given id with the dates given in the form
     *
     * @param array|null $A_parametres
     * @param array|null $A_postParams
     * @return void
     */
    public function modifyroomdatesAction(Array $A_parametres = null, Array $A_postParams = null): void
    {
        $A_room = Rooms::selectById($A_postParams['roomId']);
        if ($A_room['admin_id'] != Session::getSession()['id']) {
            header('Location: /home');
            exit;
        }
        $A_room['start_date'] = $A_postParams['start_date'];
        $A_room['end_date'] = $A_postParams['end_date'];
        Rooms::updateById($A_room, $A_postParams['roomId']);
        header('Location: /admin/modifyroom/'.$A_postParams['roomId']);
        exit;
    }

    /**
     * Redirects to the home page if the user is not the admin of the room,
     * else delete user from the room's whitelist with the given id
     *
     * @param array|null $A_parametres
     * @param array|null $A_postParams
     * @return void
     */
    public function blacklistuserAction(Array $A_parametres = null, Array $A_postParams = null) {
        $A_room = Rooms::selectById($A_postParams['roomId']);
        if ($A_room['admin_id'] != Session::getSession()['id']) {
            header('Location: /admin/multiplayer');
            exit;
        }
        Whitelist::deleteByRoomIdAndUserId($A_postParams['roomId'], $A_postParams['user_id']);
        header('Location: /admin/modifyroom/'.$A_postParams['roomId']);
        exit;
    }

    /**
     * Redirects to the home page if the user is not the admin of the room,
     * else invites users to the room with the given id with the emails given in the form
     * and adds them to the room's whitelist
     *
     * @param array|null $A_parametres
     * @param array|null $A_postParams
     * @return void
     */
    public function inviteusersAction($A_parametres = null, Array $A_postParams = null) {
        $A_unSignedUsers = array();
        $A_room = Rooms::selectById($A_postParams['roomId']);
        if ($A_room['admin_id'] != Session::getSession()['id']) {
            header('Location: /admin/multiplayer');
            exit;
        }
        $A_users = explode(',',$A_postParams['userList']);
        $A_inviteMessageContent = array('subject' => 'Invitation dans un salon de jeu Find the breach',
            'body' => 'Vous avez été invité à rejoindre une salle de Jeu sur FindTheBreach ! 
            Le nom de la salle est : '. $A_room['name'] . ' et son code pour la rejoindre est : ' .
            $A_room['id'] . ' À très vite !',);
        foreach ($A_users as $S_UserMail) {
            if(Users::checkIfExistsByEmail($S_UserMail)) {
                Whitelist::create(array('user_id' => Users::selectByEmail($S_UserMail)['id'], 'room_id' => $A_postParams['roomId']));
                Mailer::sendMail($S_UserMail, $A_inviteMessageContent);
            } else {
                $A_unSignedUsers [] = $S_UserMail;
            }
        }
        $A_parametres[0] = $A_postParams['roomId'];
        $A_parametres[1] = $A_unSignedUsers;
        $this->modifyroomAction($A_parametres, $A_postParams);
    }

    /**
     * Redirects to the home page if the user is not an admin,
     * else deletes or modify the question with the given id with the datas given in the form
     *
     * @param array|null $A_parametres
     * @param array|null $A_postParams
     * @return void
     */
    public function modifyOrDeleteQuestionAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        if (!Session::isAdmin()) {
            header("location: /home");
        }
        Questions::form($A_postParams);
        header("location: /admin");
    }

    /**
     * Redirects to the home page if the user is not the admin of the room,
     * else deletes or modify the question with the given id with the datas given in the form
     *
     * @param array|null $A_parametres
     * @param array|null $A_postParams
     * @return void
     */
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

    /**
     * Redirects to the home page if the user is not an admin,
     * else adds a question with the datas given in the form
     *
     * @param array|null $A_parametres
     * @param array|null $A_postParams
     * @return void
     */
    public function addQuestionAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        if (!Session::isAdmin()) {
            header("location: /home");
            exit;
        }
        Questions::add($A_postParams);
        header("location: /admin");
    }

    /**
     * Redirects to the home page if the user is not the admin of the room,
     * else adds a question in the room with the datas given in the form
     *
     * @param array|null $A_parametres
     * @param array|null $A_postParams
     * @return void
     */
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

    /**
     * Redirects to the home page if the user is not an admin,
     * else add an admin with the datas given in the form
     *
     * @param array|null $A_parametres
     * @param array|null $A_postParams
     * @return void
     */
    public function addAdminAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        if (!Session::isAdmin()) {
            header("location: /home");
            exit;
        }
        Admins::create($A_postParams);
        header("location: /admin/users");
    }

    /**
     * Redirects to the home page if the user is not an admin,
     * else deletes the admin with the given id
     *
     * @param array|null $A_parametres
     * @param array|null $A_postParams
     * @return void
     */
    public function deleteAdminAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        if (!Session::isAdmin()) {
            header("location: /home");
            exit;
        }
        Admins::deleteByID($A_postParams['id']);
        header("location: /admin/users");
    }

    /**
     * Redirects to the home page if the user is not an admin,
     * else deletes the user with the given id
     *
     * @param array|null $A_parametres
     * @param array|null $A_postParams
     * @return void
     */
    public function deleteUserAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        if (!Session::isAdmin()) {
            header("location: /home");
            exit;
        }
        Admins::deleteByID($A_postParams['id']);
        Users::deleteByID($A_postParams['id']);
        header("location: /admin/users");
    }

    /**
     * Redirects to the home page if the user is not an admin,
     * else generates a csv file with the scores requested and download it
     *
     * @param array|null $A_parametres
     * @param array|null $A_postParams
     * @return void
     */
    public function getScoreAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        if (!Session::isAdmin()) {
            header("location: /home");
            exit;
        }
        Files::score(Rooms::getScore($A_postParams));
        Files::download("score.txt","Files/score.txt");
    }

        /**
     * Redirects to the home page if the user is not an admin,
     * else generates a csv file with the scores requested and download it
     *
     * @param array|null $A_parametres
     * @param array|null $A_postParams
     * @return void
     */
    public function getScoreRoomAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        if (!Session::isAdmin()) {
            header("location: /signin");
            exit;
        }
        Files::score(Rooms::getScoreRoom($A_postParams));
        Files::download("score.txt","Files/score.txt");
    }

    /**
     * Redirects to the home page if the user is not an admin,
     * else generates an example of csv file and download it
     *
     * @param array|null $A_parametres
     * @param array|null $A_postParams
     * @return void
     */
    public function getfilequestionsAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        if (!Session::isAdmin()) {
            header("location: /home");
            exit;
        }
        Files::download("ListeDesQuestions.csv","Files/questions.csv");
    }

    /**
     * Redirects to the home page if the user is not an admin,
     * else adds the questions with the csv file given in the form
     *
     * @param array|null $A_parametres
     * @param array|null $A_postParams
     * @return void
     */
    public function getquestionfromfileAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        if (!Session::isAdmin()) {
            header("location: /home");
            exit;
        }
        $S_origin = $_FILES['file']['tmp_name'];
        $S_path = 'Files/ '.$_FILES['file']['name'];
        move_uploaded_file($S_origin,$S_path);
        $A_questions = Files::readquestion($S_path, $A_postParams['room_id']);
        unlink($S_path);
        Questions::deleteByRoom($A_questions[0]["room_id"]);
        foreach($A_questions as $A_question){
            Questions::create($A_question);
        }
        header("location: /admin");
    }
}
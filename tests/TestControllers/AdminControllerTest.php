<?php

include_once '../../Core/AutoLoad.php';

use PHPUnit\Framework\TestCase;

class AdminControllerTest extends TestCase{

    public function testDefaultAction(){
        Session::start("admin", "test");
        $controller = new AdminController();
        $A_questions = array ("training" => Questions::getQuestionArray("practice", "Admin/modifyOrDeleteQuestion"), "play" => Questions::getQuestionArray("game","Admin/modifyOrDeleteQuestion"));
        $S_content = View::show("admin/admin-nav").View::show("admin/solo", $A_questions);
        $this->assertEquals($S_content,$controller->defaultAction());
    }


    public function testMultiplayerAction(){
        Session::start("admin", "test");
        $controller = new AdminController();
        $S_content = View::show("admin/admin-nav").View::show("admin/multiplayer", Rooms::selectRoomsByAdmin(Session::getSession()['id']));
        $this -> assertEquals($S_content,$controller->multiplayerAction());
    }

    public function testUsersAction(){
        Session::start("admin", "test");
        $controller = new AdminController();
        $S_content = View::show("admin/admin-nav").View::show("admin/users");
        $this -> assertEquals($S_content,$controller->usersAction());
    }



}

<?php

include_once '../../Core/AutoLoad.php';
use PHPUnit\Framework\TestCase;

class UserControllerTest extends TestCase{
    public function testDefaultAction(){
        Session::start("admin", "nils");
        $controller = new UserController();
        $S_content = View::show("User/profil", Users::selectById(Session::getSession()['id'])) .            View::show("User/score", Users::selectMyScore(Session::getSession()['id'])) .            View::show("User/feed-back", Users::selectMyFeedBack(Session::getSession()['id']));
        $this->assertEquals($S_content,$controller->defaultAction());
    }
}

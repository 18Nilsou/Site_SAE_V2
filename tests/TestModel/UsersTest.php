<?php

include_once '../../Core/AutoLoad.php';

use PHPUnit\Framework\TestCase;


class UsersTest extends TestCase
{

    public function testSelectMyScore()
    {
        $S_id = '1';
        $this->assertIsArray(Users::selectMyScore($S_id));
    }

    public function testSelectMyFeedBack()
    {
        $S_id = '1';
        $this->assertIsArray(Users::selectMyFeedBack($S_id));
    }

    public function testaddfeedbackAction()
    {
        $userController  = new UserController();
        $this->assertEquals(View::show("feedback/add"), $userController ->defaultAction());
    }


}

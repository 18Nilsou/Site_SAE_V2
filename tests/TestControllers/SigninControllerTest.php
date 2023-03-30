<?php

include_once '../../Core/AutoLoad.php';

use PHPUnit\Framework\TestCase;

class SigninControllerTest extends TestCase
{

    public function testDefaultAction()
    {
        $signinController  = new SigninController();
        $this->assertEquals(View::show("signin/form"), $signinController ->defaultAction());

    }

    public function testConnectAction()
    {
        $SigninController = new SigninController;
        $SigninController->connectAction(['param1', 'param2'], ['id' => 1]);
        $this->assertTrue(true);

    }
}

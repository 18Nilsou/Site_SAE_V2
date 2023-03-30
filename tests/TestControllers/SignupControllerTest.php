<?php

include_once '../../Core/AutoLoad.php';

use PHPUnit\Framework\TestCase;

class SignupControllerTest extends TestCase
{

    public function testDefaultAction()
    {
        $signupController  = new SigninController();
        $this->assertEquals(View::show("signup/form"), $signupController ->defaultAction());
    }

}

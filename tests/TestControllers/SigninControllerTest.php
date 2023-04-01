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
}

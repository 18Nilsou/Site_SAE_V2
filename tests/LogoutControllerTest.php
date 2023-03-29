<?php

include_once '../Core/AutoLoad.php';
use PHPUnit\Framework\TestCase;

class LogoutControllerTest extends TestCase
{
    public function testDefaultAction() : void
    {
        $logoutController  = new LegalNoticeController();
        $this->assertEquals(View::show("Location: /home"), $logoutController ->defaultAction());

    }

}

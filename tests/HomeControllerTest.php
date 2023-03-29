<?php

include_once '../Core/AutoLoad.php';
use PHPUnit\Framework\TestCase;

class HomeControllerTest extends TestCase
{
    public function testDefaultAction()
    {
        $homeController = new HomeController();
        $this->assertNull($homeController->defaultAction());
    }
}

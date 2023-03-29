<?php

include_once '../Core/AutoLoad.php';
use PHPUnit\Framework\TestCase;

class LegalNoticeControllerTest extends TestCase
{
    public function testDefaultAction(): void
    {
        $controller = new LegalNoticeController();
        $this->assertEquals(View::show("legalnotice/privacypolicy"), $controller->defaultAction());
    }

    public function testGeneraltermsofuseAction(): void
    {
        $controller = new LegalNoticeController();
        $this->assertEquals(View::show("legalnotice/generaltermsofuse"), $controller->generaltermsofuseAction());
    }

}

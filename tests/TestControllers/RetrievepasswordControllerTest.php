<?php

include_once '../../Core/AutoLoad.php';

use PHPUnit\Framework\TestCase;

class RetrievepasswordControllerTest extends TestCase
{
    public function testDefaultAction(): void
    {
        $retrievepasswordController  = new RetrievepasswordController();
        $this->assertEquals(View::show("retrievepassword/form"), $retrievepasswordController ->defaultAction());
    }

}

<?php

include_once '../Core/AutoLoad.php';
use PHPUnit\Framework\TestCase;

class RetrievepasswordTest extends TestCase
{

    public function testGenToken()
    {
        $I_token = RetrievePassword::genToken();
        $this->assertTrue(is_int($I_token));
        $this->assertTrue($I_token > 100000 && $I_token < 999999);
    }

}

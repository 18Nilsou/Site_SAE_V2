<?php

use PHPUnit\Framework\TestCase;

include_once '../../Core/AutoLoad.php';


class CheckemailTest extends TestCase
{
    public function testGenToken(): void
    {
        $result = Checkemail::genToken('myId');
        $this->assertIsString($result);
        $this->assertGreaterThan(0, strlen($result));
    }

}

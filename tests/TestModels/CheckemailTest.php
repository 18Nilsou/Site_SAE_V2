<?php

use PHPUnit\Framework\TestCase;

include_once '../../Core/AutoLoad.php';


class CheckemailTest extends TestCase
{
    public function testGenToken(): void
    {
        $result = Checkemail::genToken();
        $this->assertIsInt($result);
        $this->assertGreaterThan(99999, $result);
    }

}

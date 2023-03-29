<?php

use PHPUnit\Framework\TestCase;
include_once '../Core/AutoLoad.php';


class CheckemailTest extends TestCase
{

    public function testGenToken(): void
    {
        $result = Checkemail::genToken('myId');
        $this->assertIsString($result);
        $this->assertGreaterThan(0, strlen($result));
    }

    public function testSendmail()
    {
        $A_params = array('id' => 12, 'email' => 'example@example.com', 'password' => 'mypassword');
        Checkemail::sendmail($A_params);
        $this->assertTrue(Checkemail::selectByToken($A_params['token']));
    }


}

<?php


use PHPUnit\Framework\TestCase;
include_once '../Core/AutoLoad.php';

class DoubleAuthenticationTest extends TestCase
{

    /**
     * @test
     */
    public function genToken()
    {
        $id = '1';
        $result = DoubleAuthentication::genToken($id);
        $this->assertEquals(128, strlen($result));
    }
}

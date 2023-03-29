<?php

namespace Test\Test;

use PHPUnit\Framework\TestCase;

class UsersTest extends TestCase{

    public function data(){
        return array("id" => "phpUnit", "password" => "phpUnit", "lastname" => "phpUnit", "name", "email" => "phpUnit@phpUnit.com");
    }


    public function testCheckIfExistsByEmail()
    {
        $this->assertSame("user",Users::isUser($this->data()));
    }

    public function testSelectByEmail()
    {

    }

    public function testGetStatus()
    {

    }

    public function testSelectMyScore()
    {

    }

    public function testConnect()
    {

    }

    public function testIsUser()
    {

    }

    public function testSelectMyFeedBack()
    {

    }
}

<?php

include_once '../../Core/AutoLoad.php';

use PHPUnit\Framework\TestCase;


class UsersTest extends TestCase
{

    public function testConnectUser(){
        $A_Params['password'] = "password";
        $A_Params['id'] = "test";
        $A_Params['email'] = "test@test.fr";
        $A_Params['name'] = "test";
        $A_Params['lastname'] = "test";
        $this->assertEquals("user",Users::connect($A_Params));
    }

    public function testConnectInvalidPassword(){
        $A_Params['password'] = "password123";
        $A_Params['id'] = "test";
        $A_Params['email'] = "test@test.fr";
        $A_Params['name'] = "test";
        $A_Params['lastname'] = "test";
        $this->assertEquals("Mot de passe ou Pseudo invalide",Users::connect($A_Params));
    }

    public function testIsUserWhenisUser(){
        $A_Params['password'] = "password";
        $A_Params['id'] = "test";
        $A_Params['email'] = "test@test.fr";
        $A_Params['name'] = "test";
        $A_Params['lastname'] = "test";
        $this->assertEquals("user", Users::isUser($A_Params));
    }

    public function testIsUserWhenisVisitor(){
        $A_Params['password'] = "password123";
        $A_Params['id'] = "visitor";
        $A_Params['email'] = "test@test.fr";
        $A_Params['name'] = "test";
        $A_Params['lastname'] = "test";
        $this->assertEquals("visitor", Users::isUser($A_Params));
    }

    public function testgetStatus(){
        $this->assertEquals("user", Users::getStatus("test"));
    }
    public function testgetStatusWhenAdmin(){
        $this->assertEquals("admin", Users::getStatus("testAdmin"));
    }

    public function testcheckIfExistsByEmail(){
        $this -> assertTrue(Users::checkIfExistsByEmail("test@test.fr"));
    }

    public function testcheckIfExistsById(){
        $this -> assertTrue(Users::checkIfExistsById("test"));
    }

}

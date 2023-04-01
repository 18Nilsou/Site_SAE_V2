<?php

include_once '../../Core/AutoLoad.php';

use PHPUnit\Framework\TestCase;

class RoomsTest extends TestCase
{
    public function testUniqueId()
    {
        $this->assertEquals(strlen(Rooms::uniqueId()), 6);
    }

    public function testGetStatusWhenActive()
    {
        // Arrange
        date_default_timezone_set('Europe/Paris');
        $start_date = date("Y-m-d H:i:s", strtotime('-1 day'));
        $end_date = date("Y-m-d H:i:s", strtotime('+1 day'));

        // Act
        $status = Rooms::getStatus($start_date, $end_date);

        // Assert
        $this->assertEquals('Active', $status);
    }

    public function testGetStatusWhenInactive()
    {
        // Arrange
        date_default_timezone_set('Europe/Paris');
        $start_date = date("Y-m-d H:i:s", strtotime('-5 day'));
        $end_date = date("Y-m-d H:i:s", strtotime('-2 day'));

        // Act
        $status = Rooms::getStatus($start_date, $end_date);

        // Assert
        $this->assertEquals('Inactive', $status);
    }

    public function testGetStatusWhenIndeterminable()
    {
        // Act
        $status = Rooms::getStatus();
        // Assert
        $this->assertEquals('Indeterminable', $status);
    }

}

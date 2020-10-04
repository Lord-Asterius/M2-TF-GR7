<?php

use PHPUnit\Framework\TestCase;
include_once(__DIR__.'/../src/database/ControllerDataBase.php');
include_once(__DIR__.'/../src/globals/PageIdentifiers.php');

class DataBaseTest extends testCase
{

    public function testConnection()
    {

        $this->expectOutputRegex('.*');
        ControllerDataBase::connectToDatabase();
    }

}
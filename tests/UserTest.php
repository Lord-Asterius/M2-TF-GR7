<?php

use PHPUnit\Framework\TestCase;
use function PHPUnit\assertEquals;
use function PHPUnit\assertTrue;

include_once(__DIR__ . '/../src/database/ControllerDataBase.php');
include_once(__DIR__ . '/../src/database/User.php');
include_once(__DIR__ . '/../src/database/ControllerUser.php');
include_once(__DIR__ . '/../src/globals/PageIdentifiers.php');
include_once(__DIR__ . '/TestUtils.php');

class UserTest extends testCase
{

    private static $user;

    public static function setUpBeforeClass(): void
    {
        ControllerDataBase::connectToDatabase();
        TestUtils::cleanTables();
        self::$user = new User('Az12@4567', 'Pat', 'ateee', 'mon@mail.com',
            array(), array(), array(), '2020-09-01');
    }

    public static function tearDownAfterClass(): void
    {
        ControllerDataBase::disconnectFromDataBase();
    }

    public function testCreateUserId()
    {
        $this->assertTrue(self::$user->isSameId('Pateee'));
    }

    public function testCreateUserPassword()
    {
        $this->assertTrue(self::$user->isSamePassword('Az12@4567'));
    }

    public function testCreateUserFirstName()
    {
        $this->assertEquals('Pat', self::$user->getFirstName());
    }

    public function testCreateUserLastName()
    {
        $this->assertEquals('ateee', self::$user->getLastName());
    }

    public function testCreateUserMail()
    {
        $this->assertEquals('mon@mail.com', self::$user->getMail());
    }

    public function testCreateUserModule()
    {
        $this->assertTrue(sizeof(self::$user->getModule()) == 0);
    }

    public function testCreateUserModuleRefere()
    {
        $this->assertTrue(sizeof(self::$user->getModuleRefere()) == 0);
    }

    public function testCreateUserAbsence()
    {
        $this->assertTrue(sizeof(self::$user->getAbsence()) == 0);
    }

    public function testCreateUserDate()
    {
        $this->assertEquals('2020-09-01', self::$user->getDate());
    }

}
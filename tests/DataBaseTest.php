<?php

use PHPUnit\Framework\TestCase;

include_once(__DIR__ . '/../src/database/ControllerDataBase.php');
include_once(__DIR__ . '/../src/database/User.php');
include_once(__DIR__ . '/../src/globals/PageIdentifiers.php');
include_once(__DIR__ . '/../src/database/ControllerUser.php');
include_once(__DIR__ . '/TestUtils.php');

class DataBaseTest extends TestCase
{
    private static $user;
    private static $controllerUser;

    public static function setUpBeforeClass(): void
    {
        ControllerDataBase::connectToDatabase();
//        TestUtils::cleanTables();
        self::$user = new User('Az12@4567', 'Pat', 'ateee', 'mon@mail.com', '2020-09-01', 'ENSEIGNANT');
        self::$controllerUser = new ControllerUser(self::$user);
    }

    public static function tearDownAfterClass(): void
    {
        TestUtils::cleanTables();
        ControllerDataBase::disconnectFromDataBase();
    }

    public function testInsertUser()
    {
        self::$controllerUser->commit();

        $userFetched = ControllerUser::lookForUser('Pateee', 'Az12@4567');
        $this->assertTrue($userFetched->isSameId('Pateee'));
        $this->assertTrue($userFetched->isSamePassword('Az12@4567'));
        $this->assertEquals('Pat', $userFetched->getFirstName());
        $this->assertEquals('ateee', $userFetched->getLastName());
        $this->assertEquals('mon@mail.com', $userFetched->getMail());
        $this->assertTrue(sizeof($userFetched->getModule()) == 0);
        $this->assertTrue(sizeof($userFetched->getModuleRefere()) == 0);
        $this->assertTrue(sizeof($userFetched->getAbsence()) == 0);
        $this->assertEquals('2020-09-01', $userFetched->getDate());
        $this->assertEquals('ENSEIGNANT', $userFetched->getRole());
    }


}
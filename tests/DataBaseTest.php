<?php

use PHPUnit\Framework\TestCase;

include_once(__DIR__ . '/../src/database/ControllerDataBase.php');
include_once(__DIR__ . '/../src/database/User.php');
include_once(__DIR__ . '/../src/database/Module.php');
include_once(__DIR__ . '/../src/globals/PageIdentifiers.php');
include_once(__DIR__ . '/../src/database/ControllerUserDataBase.php');
include_once(__DIR__ . '/../src/database/ControllerModuleDataBase.php');
include_once(__DIR__ . '/TestUtils.php');

class DataBaseTest extends TestCase
{

    public static function setUpBeforeClass(): void
    {
        ControllerDataBase::connectToDatabase();
        TestUtils::cleanTables();

    }

    protected function setUp(): void
    {
        TestUtils::CreateDataTestSet();
    }

    protected function tearDown(): void
    {
        TestUtils::cleanTables();
    }

    public static function tearDownAfterClass(): void
    {
        TestUtils::cleanTables();
        ControllerDataBase::disconnectFromDataBase();
    }

    public function testInsertUser()
    {
        $user = new User(9, 'Az12@4567', 'Pat', 'ateee', 'mon@mail.com', '2020-09-01', 'ENSEIGNANT');
        $controllerUser = new ControllerUserDataBase($user);
        $controllerUser->commit();

        $userFetched = ControllerUserDataBase::lookForUser('Pateee');
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

    public function testInsertModule()
    {
        $module = new Module(9, 'test');
        $moduleController = new ControllerModuleDataBase($module);
        $moduleController->commit();

        $moduleFetched = ControllerModuleDataBase::lookForModule('test');
        $this->assertEquals('test', $moduleFetched->getName());
    }

    public function testInsertModuleTwice()
    {
        $module = new Module(9, 'test');
        $moduleController = new ControllerModuleDataBase($module);
        $moduleController->commit();
        $result = $moduleController->commit();

        $this->assertFalse($result);
    }

    public function testAddmoduleToUser()
    {
        $user = ControllerUserDataBase::lookForUser('GMendufric');
        $controllerUser = new ControllerUserDataBase($user);
        $module = ControllerModuleDataBase::lookForModule('test pas vraiment fonctionnelle');

        $controllerUser->addModuleUser($module);

        $userTest = ControllerUserDataBase::lookForSpecificUserModule($user->getId());
        $this->assertTrue($userTest->isSameId('GMendufric'));
        $this->assertEquals($user->getModule()[0], $module);
    }

    public function testAddmoduleToReferent()
    {
        $user = ControllerUserDataBase::lookForUser('GMendufric');
        $controllerUser = new ControllerUserDataBase($user);
        $module = ControllerModuleDataBase::lookForModule('test pas vraiment fonctionnelle');

        $controllerUser->addModuleReferent($module);

        $userTest = ControllerUserDataBase::lookForSpecificReferentModule($user->getId());
        $this->assertTrue($userTest->isSameId('GMendufric'));
        $this->assertEquals($user->getModuleRefere()[0], $module);
    }


}
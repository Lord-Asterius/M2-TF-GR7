<?php

use PHPUnit\Framework\TestCase;

include_once(__DIR__ . '/../src/database/ControllerDataBase.php');
include_once(__DIR__ . '/../src/database/User.php');
include_once(__DIR__ . '/../src/database/Module.php');
include_once(__DIR__ . '/../src/globals/PageIdentifiers.php');
include_once(__DIR__ . '/../src/database/ControllerUserDataBase.php');
include_once(__DIR__ . '/../src/database/ControllerModuleDataBase.php');
include_once(__DIR__ . '/../src/database/Absence.php');
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

    public function testSelectSpecificUser()
    {
        $userFetched = ControllerUserDataBase::lookForSpecificUser('GMendufric');
        $this->assertEquals($userFetched->getId(), 'GMendufric');
        $this->assertTrue($userFetched->isSamePassword('Az12@4567'));
        $this->assertEquals('Gerard', $userFetched->getFirstName());
        $this->assertEquals('Mendufric', $userFetched->getLastName());
        $this->assertEquals('Gerard.Mendufric@mail.com', $userFetched->getMail());
        $this->assertTrue(sizeof($userFetched->getModule()) == 2);
        $this->assertTrue(sizeof($userFetched->getModuleReferent()) == 0);
        $this->assertTrue(sizeof($userFetched->getAbsence()) == 0);
        $this->assertEquals('2020-09-01', $userFetched->getDate());
        $this->assertEquals('ENSEIGNANT', $userFetched->getRole());
    }

    public function testSelectSpecificUserModule()
    {
        $userFetched = ControllerUserDataBase::lookForSpecificUser('GMendufric');
        $this->assertTrue(sizeof($userFetched->getModule()) == 2);
        $this->assertTrue(sizeof($userFetched->getModuleReferent()) == 0);
        $this->assertTrue(sizeof($userFetched->getAbsence()) == 0);

        $this->assertTrue(in_array(new Module('1', 'test pas vraiment fonctionnelle'), $userFetched->getModule()));
        $this->assertTrue(in_array(new Module('2', 'etude de trucs'), $userFetched->getModule()));
    }

    public function testSelectAllUser()
    {
        $users = ControllerUserDataBase::lookForAllUser();

        $this->assertCount(4, $users);
    }

    public function testRemoveModuleToUser()
    {
        $user = ControllerUserDataBase::lookForSpecificUser('GMendufric');
        $controllerUser = new ControllerUserDataBase($user);
        $module = ControllerModuleDataBase::lookForModule('test pas vraiment fonctionnelle');
        $controllerUser->removeModuleUser($module);

        $this->assertTrue(sizeof($controllerUser->getUser()->getModule()) == 1);
        $this->assertTrue(sizeof($controllerUser->getUser()->getModuleReferent()) == 0);
        $this->assertTrue(sizeof($controllerUser->getUser()->getAbsence()) == 0);

        $this->assertTrue(!in_array(new Module('1', 'test pas vraiment fonctionnelle'), $controllerUser->getUser()->getModule()));
        $this->assertTrue(in_array(new Module('2', 'etude de trucs'), $controllerUser->getUser()->getModule()));

        $userTest = ControllerUserDataBase::lookForSpecificUser($user->getId());

        $this->assertTrue(sizeof($userTest->getModule()) == 1);
        $this->assertTrue(sizeof($userTest->getModuleReferent()) == 0);
        $this->assertTrue(sizeof($userTest->getAbsence()) == 0);

        $this->assertTrue(!in_array(new Module('1', 'test pas vraiment fonctionnelle'), $userTest->getModule()));
        $this->assertTrue(in_array(new Module('2', 'etude de trucs'), $userTest->getModule()));
    }

    public function testRemoveModuleToUserReferent()
    {
        $user = ControllerUserDataBase::lookForSpecificUser('JTanrien');
        $controllerUser = new ControllerUserDataBase($user);
        $module = ControllerModuleDataBase::lookForModule('test pas vraiment fonctionnelle');
        $controllerUser->removeModuleUserReferent($module);

        $this->assertTrue(sizeof($controllerUser->getUser()->getModule()) == 1);
        $this->assertTrue(sizeof($controllerUser->getUser()->getModuleReferent()) == 0);
        $this->assertTrue(sizeof($controllerUser->getUser()->getAbsence()) == 0);

        $this->assertTrue(!in_array(new Module('1', 'test pas vraiment fonctionnelle'), $controllerUser->getUser()->getModule()));
        $this->assertTrue(in_array(new Module('2', 'etude de trucs'), $controllerUser->getUser()->getModule()));

        $userTest = ControllerUserDataBase::lookForSpecificUser($user->getId());

        $this->assertTrue(sizeof($userTest->getModule()) == 1);
        $this->assertTrue(sizeof($userTest->getModuleReferent()) == 0);
        $this->assertTrue(sizeof($userTest->getAbsence()) == 0);

        $this->assertTrue(!in_array(new Module('1', 'test pas vraiment fonctionnelle'), $userTest->getModule()));
        $this->assertTrue(in_array(new Module('2', 'etude de trucs'), $userTest->getModule()));
    }

    public function testSelectSpecificUserModuleRefere()
    {
        $userFetched = ControllerUserDataBase::lookForSpecificUser('JTanrien');
        $this->assertTrue(sizeof($userFetched->getModule()) == 1);
        $this->assertTrue(sizeof($userFetched->getModuleReferent()) == 1);
        $this->assertTrue(sizeof($userFetched->getAbsence()) == 0);

        $this->assertTrue(in_array(new Module('1', 'test pas vraiment fonctionnelle'), $userFetched->getModuleReferent()));
        $this->assertTrue(in_array(new Module('2', 'etude de trucs'), $userFetched->getModule()));
    }

    public function testSelectSpecificUserAbsence()
    {
        $userFetched = ControllerUserDataBase::lookForSpecificUser('DDormi');
        $this->assertTrue(sizeof($userFetched->getModule()) == 1);
        $this->assertTrue(sizeof($userFetched->getModuleReferent()) == 0);
        $this->assertTrue(sizeof($userFetched->getAbsence()) == 4);

        $this->assertTrue(in_array(new Module('1', 'test pas vraiment fonctionnelle'), $userFetched->getModule()));

        $this->assertTrue(in_array(new Absence('2', 'Aqua poney', 'gnugnu', '2020-10-15 13:31:47'), $userFetched->getAbsence()));
        $this->assertTrue(in_array(new Absence('3', '', '', '2020-10-15 13:31:47'), $userFetched->getAbsence()));
        $this->assertTrue(in_array(new Absence('4', '', '', '2020-10-15 13:31:47'), $userFetched->getAbsence()));
        $this->assertTrue(in_array(new Absence('5', '', '', '2020-10-15 13:31:47'), $userFetched->getAbsence()));
    }


    public function testInsertUser()
    {
        $user = new User(9, 'Az12@4567', 'Pat', 'ateee', 'mon@mail.com', '2020-09-01', 'ENSEIGNANT');
        $controllerUser = new ControllerUserDataBase($user);
        $controllerUser->commit();

        $userFetched = ControllerUserDataBase::lookForSpecificUser('Pateee');
        $this->assertTrue($userFetched->isSameId('Pateee'));
        $this->assertTrue($userFetched->isSamePassword('Az12@4567'));
        $this->assertEquals('Pat', $userFetched->getFirstName());
        $this->assertEquals('ateee', $userFetched->getLastName());
        $this->assertEquals('mon@mail.com', $userFetched->getMail());
        $this->assertTrue(sizeof($userFetched->getModule()) == 0);
        $this->assertTrue(sizeof($userFetched->getModuleReferent()) == 0);
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

    public function testAddModuleToUser()
    {
        $user = ControllerUserDataBase::lookForSpecificUser('GMendufric');
        $controllerUser = new ControllerUserDataBase($user);
        $module = ControllerModuleDataBase::lookForModule('test pas vraiment fonctionnelle');

        $controllerUser->addModuleUser($module);

        $userTest = ControllerUserDataBase::lookForSpecificUserModule($user->getId());
        $this->assertTrue($userTest->isSameId('GMendufric'));
        $this->assertEquals($user->getModule()[1], $module);
    }


    public function testSelectAllStudentInModule()
    {
        $users = ControllerUserDataBase::lookForAllStudentInModule('test pas vraiment fonctionnelle');
        $this->assertEquals(2, sizeof($users));

        $this->assertEquals('GHotine', $users[0]->getId());
        $this->assertEquals('DDormi', $users[1]->getId());

    }

    public function testSelectAllModule()
    {
        $modules = ControllerModuleDataBase::lookForAllModule();
        $this->assertEquals(2, sizeof($modules));

        $this->assertEquals('test pas vraiment fonctionnelle', $modules[1]->getName());
        $this->assertEquals('etude de trucs', $modules[2]->getName());

    }


    public function testAddModuleToReferent()
    {
        $user = ControllerUserDataBase::lookForSpecificUser('GMendufric');
        $controllerUser = new ControllerUserDataBase($user);
        $module = ControllerModuleDataBase::lookForModule('test pas vraiment fonctionnelle');

        $controllerUser->addModuleReferent($module);

        $userTest = ControllerUserDataBase::lookForSpecificReferentModule($user->getId());
        $this->assertTrue($userTest->isSameId('GMendufric'));
        $this->assertEquals($user->getModuleReferent()[1], $module);
    }

    public function testAddAbsenceUser()
    {
        $user = ControllerUserDataBase::lookForSpecificUser('GHotine');
        $controllerUser = new ControllerUserDataBase($user);

        $absence = new Absence('0', 'piscine', 'c\'est qui', '2020-10-15 13:31:47');

        $controllerUser->addAbsence($absence);
        $this->assertEquals($absence->getReason(), $user->getAbsence()[1]->getReason());

        $userTest = ControllerUserDataBase::lookForSpecificUser($user->getId());

        $this->assertEquals($absence->getReason(), $userTest->getAbsence()[1]->getReason());
    }

    public function testDeleteModule()
    {
        $res = ControllerModuleDataBase::deleteModule('test pas vraiment fonctionnelle');
        $this->assertTrue($res);
        $modulefetched = ControllerModuleDataBase::lookForModule('test pas vraiment fonctionnelle');
        $this->assertFalse($modulefetched);
    }

    public function testDeleteUser()
    {
        $res = ControllerUserDataBase::deleteUser('JTanrien');
        $this->assertTrue($res);
        $userfetched = ControllerUserDataBase::lookForSpecificUser('JTanrien');
        $this->assertNull($userfetched);
    }

    public function testLookForAllModule()
    {
        $modules = ControllerModuleDataBase::lookForAllModule();
        $this->assertCount(2, $modules);

    }
}
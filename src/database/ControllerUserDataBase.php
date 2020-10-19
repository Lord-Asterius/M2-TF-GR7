<?php

include_once(__DIR__ . '/ControllerDataBase.php');
include_once(__DIR__ . '/User.php');
include_once(__DIR__ . '/Module.php');
include_once(__DIR__ . '/ControllerUserDataBase.php');
include_once(__DIR__ . '/ControllerModuleDataBase.php');
include_once(__DIR__ . '/Absence.php');

class ControllerUserDataBase
{
    private $user;

    /**
     * ControllerUserDataBase constructor.
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    private function bindInsertUser()
    {
        $id = $this->user->getId();
        ControllerDataBase::getInsertUser()->bindParam(':id', $id);
        $password = $this->user->getPassword();
        ControllerDataBase::getInsertUser()->bindParam(':password', $password);
        $firstName = $this->user->getFirstName();
        ControllerDataBase::getInsertUser()->bindParam(':first_name', $firstName);
        $lastName = $this->user->getLastName();
        ControllerDataBase::getInsertUser()->bindParam(':last_name', $lastName);
        $mail = $this->user->getMail();
        ControllerDataBase::getInsertUser()->bindParam(':mail', $mail);
        $role = $this->user->getRole();
        ControllerDataBase::getInsertUser()->bindParam(':role', $role);
        $dateNaissance = $this->user->getDate();
        ControllerDataBase::getInsertUser()->bindParam(':date_naissance', $dateNaissance);
        $studentNumber = $this->user->getStudentNumber();
        ControllerDataBase::getInsertUser()->bindParam(':student_number', $studentNumber);

    }

    public function commit()
    {

        if (!self::lookForSpecificUser(self::getUser()->getId())) {
            ControllerDataBase::prepareInsertUser();
            $this->bindInsertUser();
            ControllerDataBase::getInsertUser()->execute();
        }
        return false; //the user already exist
    }

    public static function lookForSpecificUser($id)
    {
        ControllerDataBase::prepareSelectSpecificUser();
        if (ControllerDataBase::getSelectSpecificUser()->execute(array($id))) {
            $row = ControllerDataBase::getSelectSpecificUser()->fetch();
            if ($row) {
                $user = new User($row['0'], $row['password'], $row['first_name'], $row['last_name'], $row['mail'], $row['date_naissance'], $row['role'], $row['student_number']);
                $user->forceSetPassword($row['password']);
                do {
                    if ($row['15']) {
                        $moduleRefere = new Module($row['15'], $row['16']);
                        $user->addModuleReferent($moduleRefere);
                    }
                    if ($row['10']) {
                        $module = new Module($row['10'], $row['12']);
                        $user->addModule($module);
                    }
                    if ($row['17']) {
                        $absence = new Absence($row['17'], $row['reason'], $row['comment'], $row['date_time']);
                        $user->addAbsence($absence);
                    }
                } while ($row = ControllerDataBase::getSelectSpecificUser()->fetch());


                return $user;
            }
        }
        return null;
    }

    public static function lookForAllUser()
    {
        ControllerDataBase::prepareSelectAllUser();
        if (ControllerDataBase::getSelectAllUser()->execute()) {
            $row = ControllerDataBase::getSelectAllUser()->fetch();
            $users = array();
            do {
                $user = new User($row['0'], $row['password'], $row['first_name'], $row['last_name'], $row['mail'], $row['date_naissance'], $row['role'], $row['student_number']);
                $user->forceSetPassword($row['password']);
                $users[] = $user;
            } while ($row = ControllerDataBase::getSelectAllUser()->fetch());
            return $users;
        }
        return null;
    }

    public static function lookForAllStudents()
    {
        ControllerDataBase::prepareSelectAllStudent();
        if (ControllerDataBase::getSelectAllStudent()->execute()) {
            $row = ControllerDataBase::getSelectAllStudent()->fetch();
            $users = array();
            $user = null;
            do {
                if (!isset($users[$row['id']])) {
                    $user = new User($row['0'], $row['password'], $row['first_name'], $row['last_name'], $row['mail'], $row['date_naissance'], $row['role'], $row['student_number']);
                    $user->forceSetPassword($row['password']);
                    $users[$user->getId()] = $user;
                }
                if ($row['10']) {
                    $module = new Module($row['10'], $row['12']);
                    $users[$row['id']]->addModule($module);
                }
                if ($row['13']) {
                    $absence = new Absence($row['13'], $row['reason'], $row['comment'], $row['date_time']);
                    $users[$row['id']]->addAbsence($absence);
                }
            } while ($row = ControllerDataBase::getSelectAllStudent()->fetch());
            return $users;
        }
        return null;
    }

    public static function lookForAllTeacher()
    {
        ControllerDataBase::prepareSelectAllTeacher();
        if (ControllerDataBase::getSelectAllTeacher()->execute()) {
            $row = ControllerDataBase::getSelectAllTeacher()->fetch();
            $teachers = array();
            $teacher = null;
            do {
                if (!isset($teachers[$row['id']])) {
                    $teacher = new User($row['0'], $row['password'], $row['first_name'], $row['last_name'], $row['mail'], $row['date_naissance'], $row['role'], $row['student_number']);
                    $teacher->forceSetPassword($row['password']);
                    $teachers[$teacher->getId()] = $teacher;
                }
                if ($row['13']) {
                    $moduleRefere = new Module($row['13'], $row['16']);
                    $teacher->addModuleReferent($moduleRefere);
                }
                if ($row['10']) {
                    $module = new Module($row['10'], $row['12']);
                    $teachers[$row['id']]->addModule($module);
                }
            } while ($row = ControllerDataBase::getSelectAllTeacher()->fetch());
            return $teachers;
        }
        return null;
    }

    public static function lookForAllAdminStaff()
    {
        ControllerDataBase::prepareSelectAllAdminStaff();
        if (ControllerDataBase::getSelectAllAdminStaff()->execute()) {
            $row = ControllerDataBase::getSelectAllAdminStaff()->fetch();
            $AdminStaffs = array();
            $AdminStaff = null;
            do {
                if (!isset($AdminStaffs[$row['id']])) {
                    $AdminStaff = new User($row['0'], $row['password'], $row['first_name'], $row['last_name'], $row['mail'], $row['date_naissance'], $row['role'], $row['student_number']);
                    $AdminStaff->forceSetPassword($row['password']);
                    $AdminStaffs[$AdminStaff->getId()] = $AdminStaff;
                }
            } while ($row = ControllerDataBase::getSelectAllAdminStaff()->fetch());
            return $AdminStaffs;
        }
        return null;
    }

    public static function lookForAllAdmin()
    {
        ControllerDataBase::prepareSelectAllAdmin();
        if (ControllerDataBase::getSelectAllAdmin()->execute()) {
            $row = ControllerDataBase::getSelectAllAdmin()->fetch();
            $Admins = array();
            $Admin = null;
            do {
                if (!isset($Admins[$row['id']])) {
                    $Admin = new User($row['0'], $row['password'], $row['first_name'], $row['last_name'], $row['mail'], $row['date_naissance'], $row['role'], $row['student_number']);
                    $Admin->forceSetPassword($row['password']);
                    $Admins[$Admin->getId()] = $Admin;
                }
            } while ($row = ControllerDataBase::getSelectAllAdmin()->fetch());
            return $Admins;
        }
        return null;
    }


    public static function lookForSpecificUserModule($id)
    {
        ControllerDataBase::prepareSelectSpecificUserModule();
        if (ControllerDataBase::getSelectSpecificUserModule()->execute(array($id))) {
            $row = ControllerDataBase::getSelectSpecificUserModule()->fetch();
            if ($row) {
                $user = new User($row['key'], $row['password'], $row['first_name'], $row['last_name'], $row['mail'], $row['date_naissance'], $row['role'], $row['student_number']);
                $user->forceSetPassword($row['password']);
                return $user;
            }
        }
        return null;
    }

    public static function lookForSpecificReferentModule($id)
    {
        ControllerDataBase::prepareSelectSpecificReferentModule();
        if (ControllerDataBase::getSelectSpecificReferentModule()->execute(array($id))) {
            $row = ControllerDataBase::getSelectSpecificReferentModule()->fetch();
            if ($row) {
                $user = new User($row['key'], $row['password'], $row['first_name'], $row['last_name'], $row['mail'], $row['date_naissance'], $row['role'], $row['student_number']);
                $user->forceSetPassword($row['password']);
                return $user;
            }
        }
        return null;
    }

    public static function lookForAllStudentInModule($moduleName)
    {
        ControllerDataBase::prepareSelectAllStudentInModule();
        $users = array();
        if (ControllerDataBase::getSelectAllStudentInModule()->execute(array($moduleName))) {
            while ($row = ControllerDataBase::getSelectAllStudentInModule()->fetch()) {
                $user = new User($row['key'], $row['password'], $row['first_name'], $row['last_name'], $row['mail'], $row['date_naissance'], $row['role'], $row['student_number']);
                $user->forceSetPassword($row['password']);
                $users[] = $user;
            }
        }
        return $users;
    }


    public function addModuleUser(Module $module)
    {
        ControllerDataBase::prepareInsertUserModule();
        $moduleKey = $module->getKey();
        $userKey = $this->user->getKey();
        if (ControllerDataBase::getInsertUserModule()->execute(array($userKey, $moduleKey))) {
            $this->user->addModule($module);
            return true;
        }
        return false;
    }

    public function addModuleReferent(Module $module)
    {
        ControllerDataBase::prepareInsertReferentModule();
        $moduleKey = $module->getKey();
        $referentKey = $this->user->getKey();
        if (ControllerDataBase::getInsertReferentModule()->execute(array($referentKey, $moduleKey))) {
            $this->user->addModuleReferent($module);
            return true;
        }
        return false;
    }

    public function modifyUser()
    {
        ControllerDataBase::prepareModifyUser();
        return ControllerDataBase::getModifyUser()->execute(
            array($this->user->getId(), $this->user->getPassword(),
                $this->user->getFirstName(), $this->user->getLastName(),
                $this->user->getMail(), $this->user->getRole(),
                $this->user->getDate(), $this->user->getKey()));
    }

    public function modifyUserKeepPassword()
    {
        ControllerDataBase::prepareModifyUserKeepPassword();
        return ControllerDataBase::getModifyUserKeepPassword()->execute(
            array($this->user->getId(), $this->user->getFirstName(),
                $this->user->getLastName(), $this->user->getMail(),
                $this->user->getRole(), $this->user->getDate(),
                $this->user->getKey()));
    }

    public function getUser()
    {
        return $this->user;
    }

    public function addAbsence(Absence $absence)
    {
        ControllerDataBase::prepareInsertAbsence();
        if (!ControllerDataBase::getInsertAbsence()->execute(array($absence->getReason(), $this->user->getKey(), $absence->getComment(), $absence->getDate()))) {
            return false;
        }
        $this->user->addAbsence($absence);
        return true;
    }

    public static function deleteUser($userId)
    {
        ControllerDataBase::prepareDeleteUser();
        return ControllerDataBase::getDeleteUser()->execute(array($userId));
    }

    public function removeModuleUser(Module $module)
    {
        ControllerDataBase::prepareRemoveUserModule();
        $moduleKey = $module->getKey();
        $userKey = $this->user->getKey();
        if (ControllerDataBase::getRemoveUserModule()->execute(array($userKey, $moduleKey))) {
            $this->user->removeModule($module);
            return true;
        }
        return false;
    }

    public function removeModuleUserReferent(Module $module)
    {
        ControllerDataBase::prepareRemoveUserReferentModule();
        $moduleKey = $module->getKey();
        $userKey = $this->user->getKey();
        if (ControllerDataBase::getRemoveUserReferentModule()->execute(array($userKey, $moduleKey))) {
            $this->user->removeModuleReferent($module);
            return true;
        }
        return false;
    }


}
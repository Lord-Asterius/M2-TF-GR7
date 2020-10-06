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
                $user = new User($row['0'], $row['password'], $row['first_name'], $row['last_name'], $row['mail'], $row['date_naissance'], $row['role']);
                $user->forceSetPassword($row['password']);
                do {
                    if ($row['12']) {
                        $moduleRefere = new Module($row['12'], $row['15']);
                        $user->addModuleReferent($moduleRefere);
                    }
                    if ($row['9']) {
                        $module = new Module($row['9'], $row['11']);
                        $user->addModule($module);
                    }
                    if ($row['16']) {
                        $absence = new Absence($row['16'], $row['reason'], $row['comment'], $row['date_time']);
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
                $user = new User($row['0'], $row['password'], $row['first_name'], $row['last_name'], $row['mail'], $row['date_naissance'], $row['role']);
                $user->forceSetPassword($row['password']);
                $users[$user->getId()] = $user;
            } while ($row = ControllerDataBase::getSelectAllUser()->fetch());
            return $users;
        }
        return null;
    }

    public static function lookForSpecificUserModule($id)
    {
        ControllerDataBase::prepareSelectSpecificUserModule();
        if (ControllerDataBase::getSelectSpecificUserModule()->execute(array($id))) {
            $row = ControllerDataBase::getSelectSpecificUserModule()->fetch();
            if ($row) {
                $user = new User($row['key'], $row['password'], $row['first_name'], $row['last_name'], $row['mail'], $row['date_naissance'], $row['role']);
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
                $user = new User($row['key'], $row['password'], $row['first_name'], $row['last_name'], $row['mail'], $row['date_naissance'], $row['role']);
                $user->forceSetPassword($row['password']);
                return $user;
            }
        }
        return null;
    }

    public static function lookForAllStudentInModule($moduleId)
    {
        ControllerDataBase::prepareSelectAllStudentInModule();
        $users = array();
        if (ControllerDataBase::getSelectAllStudentInModule()->execute(array($moduleId))) {
            while ($row = ControllerDataBase::getSelectAllStudentInModule()->fetch()) {
                $user = new User($row['key'], $row['password'], $row['first_name'], $row['last_name'], $row['mail'], $row['date_naissance'], $row['role']);
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
<?php


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

        if (!self::lookForUser(self::getUser()->getName())) {
            ControllerDataBase::prepareInsertUser();
            $this->bindInsertUser();
            ControllerDataBase::getInsertUser()->execute();
        }
        return false; //the user already exist
    }

    public static function lookForUser($id)
    {
        ControllerDataBase::prepareSelectSpecificUser();
        if (ControllerDataBase::getSelectSpecificUser()->execute(array($id))) {
            $row = ControllerDataBase::getSelectSpecificUser()->fetch();
            if ($row) {
                $user = new User($row['0'], $row['password'], $row['first_name'], $row['last_name'], $row['mail'], $row['date_naissance'], 'ENSEIGNANT');
                $user->forceSetPassword($row['password']);
                return $user;
            }
        }

        return null;
    }

    public static function lookForSpecificUserModule($id)
    {
        ControllerDataBase::prepareSelectSpecificUserModule();
        if (ControllerDataBase::getSelectSpecificUserModule()->execute(array($id))) {
            $row = ControllerDataBase::getSelectSpecificUserModule()->fetch();
            if ($row) {
                $user = new User($row['key'], $row['password'], $row['first_name'], $row['last_name'], $row['mail'], $row['date_naissance'], 'ENSEIGNANT');
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
                $user = new User($row['key'], $row['password'], $row['first_name'], $row['last_name'], $row['mail'], $row['date_naissance'], 'ENSEIGNANT');
                $user->forceSetPassword($row['password']);
                return $user;
            }
        }
        return null;
    }


    public function addModuleUser(Module $module){
        ControllerDataBase::prepareInsertUserModule();
        $moduleKey = $module->getKey();
        $userKey = $this->user->getKey();
        if(ControllerDataBase::getInsertUserModule()->execute(array($userKey, $moduleKey))){
            $this->user->addModule($module);
            return true;
        }
        return false;
    }

    public function addModuleReferent(Module $module){
        ControllerDataBase::prepareInsertReferentModule();
        $moduleKey = $module->getKey();
        $referentKey = $this->user->getKey();
        if(ControllerDataBase::getInsertReferentModule()->execute(array($referentKey, $moduleKey))){
            $this->user->addModuleRefere($module);
            return true;
        }
        return false;
    }

    public function getUser()
    {
        return $this->user;
    }

}
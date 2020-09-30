<?php


class ControllerUser
{
    private $user;

    /**
     * ControllerUser constructor.
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
        ControllerDataBase::prepareInsertUser();
        $this->bindInsertUser();
        ControllerDataBase::getInsertUser()->execute();
    }

    public static function lookForUser($id, $password)
    {
        ControllerDataBase::prepareSelectSpecificUser();
        if (ControllerDataBase::getSelectSpecificUser()->execute(array($id))) {
            $row = ControllerDataBase::getSelectSpecificUser()->fetch();
            if ($row && password_verify($password, $row['password'])) {
                $user = new User($row['password'], $row['first_name'], $row['last_name'], $row['mail'], $row['date_naissance'], 'ENSEIGNANT');
                $user->forceSetPassword($row['password']);
                return $user;
            }
        }

        return null;
    }

    public function getUser()
    {
        return $this->user;
    }

}
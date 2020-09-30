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
        $this->bindInsertUser();
    }

    private function bindInsertUser(){
        ControllerDataBase::getInsertUser()->bindParam(':id', $this->user->id);
        ControllerDataBase::getInsertUser()->bindParam(':password', $this->user->password);
        ControllerDataBase::getInsertUser()->bindParam(':first_name', $this->user->first_name);
        ControllerDataBase::getInsertUser()->bindParam(':last_name', $this->user->last_name);
        ControllerDataBase::getInsertUser()->bindParam(':mail', $this->user->mail);
        ControllerDataBase::getInsertUser()->bindParam(':role', $this->user->role);
        ControllerDataBase::getInsertUser()->bindParam(':date_naissance', $this->user->date_naissance);
    }

    public function commit() {
        ControllerDataBase::getInsertUser()->execute();
    }

    public static function lookForUser($id, $password)
    {
        if (ControllerDataBase::getSelectSpecificUser()->execute(array($id, $password))) {
            $row = ControllerDataBase::getSelectSpecificUser()->fetch();
            return new User($row['password'], $row['first_name'], $row['last_name'], $row['mail'], $row['module'],
                $row['moduleRefere'], $row['absence'], $row['date']);
        }

        return null;
    }

    public function getUser()
    {
        return $this->user;
    }

}
<?php


class Module
{
    private $name;
    private $user;
    private $inCharge;

    /**
     * Module constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->user = array();
        $this->inCharge = array();
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getStudents(): array
    {
        return $this->user;
    }


    /**
     * @return array
     */
    public function getInCharge(): array
    {
        return $this->inCharge;
    }

    public function addUser(User $user){
        $this->user[] = $user;
    }


    public function addInCharge(User $user){
        $this->inCharge[] = $user;
    }

}
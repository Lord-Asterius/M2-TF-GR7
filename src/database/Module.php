<?php


class Module
{
    private $key;
    private $name;
    private $user;
    private $inCharge;

    /**
     * Module constructor.
     * @param $key
     * @param $name
     */
    public function __construct($key, $name)
    {
        $this->key = $key;
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

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return array
     */
    public function getUser(): array
    {
        return $this->user;
    }



    public function addInCharge(User $user){
        $this->inCharge[] = $user;
    }

}
<?php


class Absence
{
    private $reason;
    private $students;
    private $comment;

    public function __construct($reason, $comment)
    {
        $this->reason = $reason;
        $this->comment = $comment;
        $this->students = array();
    }

    /**
     * @return mixed
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @return array
     */
    public function getStudents(): array
    {
        return $this->students;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    public function addStudent(User $user){
        $this->students[] = $user;
    }


}
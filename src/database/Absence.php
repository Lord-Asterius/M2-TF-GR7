<?php


class Absence
{
    private $key;
    private $reason;
    private $comment;
    private $date;


    public function __construct($key, $reason, $comment, $date)
    {
        $this->key = $key;
        $this->reason = $reason;
        $this->comment = $comment;
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getReason()
    {
        return $this->reason;
    }


    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }




}
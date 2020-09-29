<?php


abstract class AbstractPerson
{
    private $key;
    private $id;
    private $password;
    private $first_name;
    private $last_name;
    private $mail;


    public abstract function __construct($id, $password, $first_name, $last_name, $key);
    public abstract function commit();
    public static abstract function getCreateAllPerson();
    public function getId()
    {
        return $this->id;
    }

    public function isSameId(string $id)
    {
        return $this->id == $id;
    }


    public function setId(string $id): void
    {
        $this->id = $id;
    }


    public function getFirstName()
    {
        return $this->first_name;
    }


    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
    }


    public function getLastName()
    {
        return $this->last_name;
    }


    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }


    public function getMail()
    {
        return $this->mail;
    }


    public function setMail(string $mail): void
    {
        $this->mail = $mail;
    }


    public function setPassword(string $password): array
    {
        $errors = array();

        if (strlen($password) < 8) {
            $errors[] = "Password should be min 8 characters and max 16 characters";
        }
        if (!preg_match("/\d/", $password)) {
            $errors[] = "Password should contain at least one digit";
        }
        if (!preg_match("/[A-Z]/", $password)) {
            $errors[] = "Password should contain at least one Capital Letter";
        }
        if (!preg_match("/[a-z]/", $password)) {
            $errors[] = "Password should contain at least one small Letter";
        }
        if (!preg_match("/\W/", $password)) {
            $errors[] = "Password should contain at least one special character";
        }
        if (preg_match("/\s/", $password)) {
            $errors[] = "Password should not contain any white space";
        }
        if (count($errors) != 0) {
            $this->password = password_hash($password, PASSWORD_DEFAULT);;
        }

        return $errors;

    }

    public function isSamePassword(string $password)
    {
        return password_verify($password, $this->password);
    }

    public function getKey()
    {
        return $this->key;
    }
}

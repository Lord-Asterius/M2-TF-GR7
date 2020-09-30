<?php


class User
{
    private $key;
    private $id;
    private $password;
    private $firstName;
    private $lastName;
    private $mail;
    private $module;
    private $moduleRefere;
    private $absence;
    private $date;
    private $role; //'ENSEIGNANT','EQUIPE_ADMINISTRATIVE','ADMINISTRATEUR','ETUDIANT',''

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role): void
    {
        $this->role = $role;
    }

    public function __construct($password, $first_name, $last_name, $mail, $date, $role)
    {
        $this->setPassword($password);
        $this->firstName = $first_name;
        $this->lastName = $last_name;
        $this->setId();
        $this->mail = $mail;
        $this->setMail($mail);
        $this->module = array();
        $this->moduleRefere = array();
        $this->absence = array();
        $this->date = $date;
        $this->role = $role;
    }

    /**
     * Don't use that if you want to Insert inside the DB
     * @param $hashedPassword
     */
    public function forceSetPassword($hashedPassword) {
        $this->password = $hashedPassword;
    }

    public function getModule()
    {
        return $this->module;
    }

    public function getModuleRefere()
    {
        return $this->moduleRefere;
    }

    public function getAbsence()
    {
        return $this->absence;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date): void
    {
        $this->date = $date;
    }

    public function getId()
    {
        return $this->id;
    }

    public function isSameId(string $id)
    {
        return $this->id == $id;
    }

    public function setId(): void
    {
        $this->id = substr($this->firstName, 0, 1) . $this->lastName;
    }


    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setMail(string $mail): array
    {
        $emailErr = array();
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $emailErr[] = "Invalid email format";
        } else {
            $this->mail = $mail;
        }

        return $emailErr;
    }

    public function setPassword(string $password): array
    {
        $errors = array();

        if (strlen($password) < 8) {
            $errors[] = "Password should be min 8 characters and max 16 characters";
        }
        if (!preg_match("/\d/", $password)) {
            $errors[] = "Password should contain at least one digigett";
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
        if (count($errors) == 0) {
            $this->password = password_hash($password, PASSWORD_DEFAULT);
        }

        return $errors;
    }

    public function addModule(Module $module)
    {
        $this->module[] = $module;
    }

    public function addAbsence(Absence $absence)
    {
        $this->absence[] = $absence;
    }

    public function addModuleRefere(Module $module)
    {
        $this->moduleRefere[] = $module;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function isSamePassword(string $password)
    {
        return password_verify($password, $this->password);
    }
}

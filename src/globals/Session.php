<?php

class Session
{

    static public function logout()
    {
        $_SESSION['id'] = NULL;
        $_SESSION['role'] = NULL;
    }

    static public function setSession($id, $role)
    {
        $_SESSION['id'] = $id;
        $_SESSION['role'] = $role;
    }

    static public function getId(){
        return $_SESSION['id'];
    }

    static public function getRole(){
        return $_SESSION['role'];
    }

}

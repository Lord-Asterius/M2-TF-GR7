<?php

include_once(dirname(__FILE__) . "/../globals/Utils.php");
include_once(dirname(__FILE__) . "/../database/ControllerDataBase.php");

class ControllerDisconnection
{
    public function __construct(){
        session_start();
    }
    public function disconnection()
    {
        $_SESSION['user'] = null;
        ControllerDataBase::disconnectFromDataBase();
        Utils::redirectTo(PAGE_ID_CONNECTION, []);
    }
}
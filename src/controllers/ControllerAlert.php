<?php

include_once(dirname(__FILE__) . "/../views/ViewAlert.php");
include_once(dirname(__FILE__) . "/../database/ControllerDataBase.php");
include_once(dirname(__FILE__) . "/../database/ControllerUserDataBase.php");
include_once(dirname(__FILE__) . "/../globals/Utils.php");
include_once(dirname(__FILE__) . '/../database/User.php');
include_once(dirname(__FILE__) . '/../database/Module.php');
include_once(dirname(__FILE__) . '/../database/Absence.php');


class ControllerAlert
{
    private $m_viewAlert;

    public function __construct()
    {
        $this->m_viewAlert = new ViewAlert();
    }

    public function handleRequest()
    {
        ControllerDataBase::connectToDatabase();

        $this->m_viewAlert->setAlertList([["21300598", "Fabien Perreux", "3", "1"], ["21300599", "Fabrice Bouquet", "4", "2"], ["21300597", "Julien Bernard", "5", "3"]]);
        $this->m_viewAlert->render();
    }
}
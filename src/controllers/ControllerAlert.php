<?php

include_once(dirname(__FILE__) . "/../views/ViewAlert.php");

class ControllerAlert
{
    private $m_viewAlert;

    public function __construct()
    {
        $this->m_viewAlert = new ViewAlert();
    }

    public function handleRequest($getParameters)
    {
        $this->m_viewAlert->setAlertList([["Fabien Perreux", "3", "1"], ["Fabrice Bouquet", "4", "2"], ["Julien Bernard", "5", "3"]]);
        $this->m_viewAlert->render();
    }
}
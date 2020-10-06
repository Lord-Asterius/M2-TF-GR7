<?php

include_once(dirname(__FILE__) . "/../globals/PageIdentifiers.php");
include_once(dirname(__FILE__) . "/../globals/Utils.php");
include_once(dirname(__FILE__) . "/../views/ViewAdministration.php");


class ControllerAdministration
{
    private $m_viewAdministration;

    public function __construct()
    {
        $this->m_viewAdministration = new ViewAdministration();
    }

    public function handleRequest($getParameters)
    {
        $this->m_viewAdministration->render();

    }

}
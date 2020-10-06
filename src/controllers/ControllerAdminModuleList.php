<?php

include_once(dirname(__FILE__) . "/../views/ViewAdminModuleList.php");


class ControllerAdminModuleList
{
    private $m_viewAdminModuleList;

    public function __construct()
    {
        $this->m_viewAdminModuleList = new ViewAdminModuleList();
    }

    public function handleRequest($getParameters)
    {

        $this->m_viewAdminModuleList->setModulesNamesList(["Test fonctionnel", "PAM", "Réseaux avancé"]);
        $this->m_viewAdminModuleList->render();
    }
}
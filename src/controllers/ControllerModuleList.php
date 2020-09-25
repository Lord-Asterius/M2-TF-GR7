<?php

include_once(dirname(__FILE__) . "/../views/ViewModuleList.php");


class ControllerModuleList
{
    private $m_viewModuleList;

    public function __construct()
    {
        $this->m_viewModuleList = new ViewModuleList();
    }

    public function handleRequest($getParameters)
    {
        //TODO Get the list of module the current user have access to
        $this->m_viewModuleList->setModulesNamesList(["Test fonctionnel", "PAM", "Réseaux avancé"]);
        $this->m_viewModuleList->render();
    }
}
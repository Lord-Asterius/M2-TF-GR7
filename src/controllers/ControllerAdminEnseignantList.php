<?php

include_once(dirname(__FILE__) . "/../views/ViewAdminEnseignantList.php");


class ControllerAdminEnseignantList
{
    private $m_viewAdminEnseignantList;

    public function __construct()
    {
        $this->m_viewAdminEnseignantList = new ViewAdminEnseignantList();
    }

    public function handleRequest($getParameters)
    {
        
        $this->m_viewAdminEnseignantList->setEnseignantsNamesList(["Test fonctionnel", "PAM", "Réseaux avancé"]);
        $this->m_viewAdminEnseignantList->render();
    }
}
<?php

include_once(dirname(__FILE__) . "/../views/ViewEnseignantList.php");


class ControllerEnseignantList
{
    private $m_viewEnseignantList;

    public function __construct()
    {
        $this->m_viewEnseignantList = new viewEnseignantList();
    }

    public function handleRequest($getParameters)
    {
                    $this->m_viewEnseignantList->setEnseignantList(["Bouque Fabrice", "Fabien Peureux", "Autre Enseignant"]);
                    $this->m_viewEnseignantList->render();
}
}
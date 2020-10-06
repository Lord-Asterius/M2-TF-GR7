<?php

include_once(dirname(__FILE__) . "/../views/ViewEnseignantList.php");
include_once(dirname(__FILE__) . "/../database/ControllerDataBase.php");
include_once(dirname(__FILE__) . "/../database/ControllerUserDataBase.php");


class ControllerEnseignantList
{
    private $m_viewEnseignantList;

    public function __construct()
    {
        $this->m_viewEnseignantList = new viewEnseignantList();
    }

    public function handleRequest($getParameters)
    {
        ControllerDataBase::connectToDatabase();
        // $enseignants =ControllerUserDataBase::();
        $enseignantsName=array();
        foreach($enseignants as $enseignant){
            array_push($enseignantsName,$enseignant->getName());
        }
        $this->m_viewAdminModuleList->setModulesNamesList($modulesName);

                    $this->m_viewEnseignantList->setEnseignantList(["Bouque Fabrice", "Fabien Peureux", "Autre Enseignant"]);
                    $this->m_viewEnseignantList->render();
}
}
<?php

include_once(dirname(__FILE__) . "/../views/ViewEnseignantList.php");
include_once(dirname(__FILE__) . "/../database/ControllerDataBase.php");
include_once(dirname(__FILE__) . "/../database/ControllerUserDataBase.php");


class ControllerEnseignantList
{
    private $m_viewEnseignantList;

    public function __construct()
    {
        ControllerDataBase::connectToDatabase();

        $this->m_viewEnseignantList = new viewEnseignantList();
    }

    public function handleRequest($getParameters)
    {
        $enseignants =ControllerUserDataBase::lookForAllTeacher();

        $tab= array();
        foreach($enseignants as $enseignant){
            $tab[$enseignant->getId()] =$enseignant->getFirstName().' '.$enseignant->getLastName();
        }
        $this->m_viewEnseignantList->setEnseignantList($tab);
        $this->m_viewEnseignantList->render();
    }
    public function deleteEnseignant($getParameters){
        $etudiants =ControllerUserDataBase::deleteUser($getParameters["key"]);
        $this->handleRequest($getParameters);
    }
}
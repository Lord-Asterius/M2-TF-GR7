<?php

include_once(dirname(__FILE__) . "/../views/ViewEnseignantList.php");
include_once(dirname(__FILE__) . "/../database/ControllerDataBase.php");
include_once(dirname(__FILE__) . "/../database/ControllerUserDataBase.php");
//todo enlver controller enseignant edit et renommer ce fichier en controllerEnseignant

class ControllerEnseignantList
{
    private $m_viewEnseignantList;
    private $m_viewEnseignantEdit;

    public function __construct()
    {
        ControllerDataBase::connectToDatabase();

        $this->m_viewEnseignantList = new viewEnseignantList();
        $this->m_viewEnseignantEdit = new viewEnseignantEdit();

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
        $enseignants =ControllerUserDataBase::deleteUser($getParameters["key"]);
        $this->handleRequest($getParameters);
    }
    public function modifyAdminEnseignant($getParameters){
        echo " PRESEEENT";
     //todo securisé en verifiant que chaque parametre possède bien une valeur et que le password repond aux exigences
     if ($getParameters["key"]){
        $user = ControllerUserDataBase::lookForSpecificUser($getParameters["key"]);
        $controllerUser = new ControllerUserDataBase($user);
        $user->setLastName($_POST['last_name']);
        $user->setFirstName($_POST['first_name']);
        $user->setPassword($_POST['password']);
        $date= new datetime($_POST['date']);
        $date= $date->format("Y-m-d");
        $user->setDate($date);
        $user->setMail($_POST['mail']);
        $controllerUser->modifyUser();
     }
     $this->handleRequest($getParameters);
    }
    public function addEnseignant($getParameters){
        $date= new datetime($_POST['date']);
        $date= $date->format("Y-m-d");
        $user= new User(4,$_POST['password'],$_POST['first_name'],$_POST['last_name'],$_POST['mail'],$date,'ENSEIGNANT');
        $controllerUser = new ControllerUserDataBase($user);
        $controllerUser->commit();
        $this->handleRequest($getParameters);
    }
    public function editEnseignant($getParameters){
        // if modifiy Student 
        if ( isset($getParameters["key"])){
            $user = ControllerUserDataBase::lookForSpecificUser($getParameters["key"]);
            if($user->getFirstName() && $user->getLastName() && $user->getDate() && $user->getMail()){
                $tab= array();
                $tab['first_name'] = $user->getFirstName();
                $tab['last_name'] = $user->getLastName();
                $date= new datetime($user->getDate());
                $date= $date->format("d/m/Y");
                $tab['date'] = $date;
                $tab['mail'] = $user->getMail();
        
                $this->m_viewEnseignantEdit->setDataEnseignantEdit($tab);
            }
        }
        //else just add then display render
        $this->m_viewEnseignantEdit->render();
    }
}
<?php

include_once(dirname(__FILE__) . "/../views/ViewEtudiantList.php");

//todo renommé classe en ControlleAdminEtudiant tout silmple  et suppression controllerEtudiantEdit

class ControllerEtudiantList
{
    private $m_viewEtudiantList;
    private $m_viewEtudiantEdit;

    public function __construct()
    {
        ControllerDataBase::connectToDatabase();
        $this->m_viewEtudiantList = new viewEtudiantList();
        $this->m_viewEtudiantEdit = new viewEtudiantEdit();
    }

    public function handleRequest($getParameters)
    {
        $etudiants =ControllerUserDataBase::lookForAllStudents();

        $tab= array();
        foreach($etudiants as $etudiant){
            $tab[$etudiant->getId()] =$etudiant->getFirstName().' '.$etudiant->getLastName();
        }
        $this->m_viewEtudiantList->setEtudiantList($tab);
        $this->m_viewEtudiantList->render();
}
    public function deleteEtudiant($getParameters){
        $etudiants =ControllerUserDataBase::deleteUser($getParameters["key"]);
        $this->handleRequest($getParameters);
    }
    public function editEtudiant($getParameters){
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
        
                $this->m_viewEtudiantEdit->setDataEtudiantEdit($tab);
            }
        }
        //else just add then display render
        $this->m_viewEtudiantEdit->render();
    }
    public function modifyAdminEtudiant($getParameters){
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
    public function addEtudiant($getParameters){
        $date= new datetime($_POST['date']);
        $date= $date->format("Y-m-d");
        $user= new User(4,$_POST['password'],$_POST['first_name'],$_POST['last_name'],$_POST['mail'],$date,'ETUDIANT');
        $controllerUser = new ControllerUserDataBase($user);
        $controllerUser->commit();
        $this->handleRequest($getParameters);
    }
}
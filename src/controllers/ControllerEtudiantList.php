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
        $this->m_viewEtudiantEdit->render();
    }
    public function modifyEtudiant($getParameters){
        $userFetched = ControllerUserDataBase::lookForSpecificUser($getParameters["key"]);
        // print_r($userFetched);
        $tab= array(
            // todo faire les clés values pour remplir l'édition
        );
        $this->m_viewEtudiantEdit->setDataEtudiant($userFetched);
        $this->m_viewEtudiantEdit->render();
    }
    public function addEtudiant($getParameters){
        // print_r($_POST);
        $date = str_replace("/", "-", $_POST['date']);
        $user= new User(4,$_POST['password'],$_POST['first_name'],$_POST['last_name'],$_POST['mail'],$date,'ETUDIANT');
        // echo " date ".$user->getDate();
        // todo rectifié le format de date en AAAA-MM-JJ
        $controllerUser = new ControllerUserDataBase($user);
        $controllerUser->commit();
        $this->handleRequest($getParameters);

    }
}
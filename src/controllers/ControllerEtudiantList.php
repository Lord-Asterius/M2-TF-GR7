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
        $etudiants = ControllerUserDataBase::lookForAllStudents();

        $tab = array();
        foreach ($etudiants as $etudiant) {
            $tab[$etudiant->getId()] = $etudiant->getFirstName() . ' ' . $etudiant->getLastName();
        }
        $this->m_viewEtudiantList->setEtudiantList($tab);
        $this->m_viewEtudiantList->render();
    }

    public function deleteEtudiant($getParameters)
    {
        $etudiants = ControllerUserDataBase::deleteUser($getParameters["key"]);
        $this->handleRequest($getParameters);
    }

    public function editEtudiant($getParameters)
    {
        // if modifiy Student 
        if (isset($getParameters["key"])) {
            $user = ControllerUserDataBase::lookForSpecificUser($getParameters["key"]);
            if ($user->getFirstName() && $user->getLastName() && $user->getDate() && $user->getMail()) {
                $tab = array();
                $tab['first_name'] = $user->getFirstName();
                $tab['last_name'] = $user->getLastName();
                $date = new datetime($user->getDate());
                $date = $date->format("d/m/Y");
                $tab['date'] = $date;
                $tab['mail'] = $user->getMail();
                $tab['student_number'] = $user->getStudentNumber();

                $this->m_viewEtudiantEdit->setDataEtudiantEdit($tab);
            }
        }
        //else just add then display render
        $this->m_viewEtudiantEdit->render($getParameters);
    }

    public function checkUserValidField($id)
    {
        $errorToDisplay = "";

//        if (count(User::isPasswordValid($_POST['password'])) != 0) {
//            $errorToDisplay = $errorToDisplay . "Mot de pass : min 8 caracteres; au moins un nombre, une majuscule, minuscule et un caractere spécial.\n";
//        }

        if (!(preg_match("/[a-zA-Z]/", $_POST['last_name']) && preg_match("/[a-zA-Z]/", $_POST['first_name']))) {
            $errorToDisplay = $errorToDisplay . "Le nom et prénom de l'utilisateurs doivent contenir uniquement des lettres\n";
        }

        if (!(preg_match("/[1-9]/", $_POST['student_number']))) {
            $errorToDisplay = $errorToDisplay . "Le numéro d'étudiant ne doit contenir que des chiffres\n";
        }

        if ($errorToDisplay != "") {
            Utils::redirectTo(PAGE_ID_ETUDIANT_EDIT, ["key" => $id, "error" => $errorToDisplay]);
        }
    }

    public function modifyAdminEtudiant($getParameters)
    {
        $this->checkUserValidField($getParameters["key"]);
        if ($getParameters["key"]) {
            $user = ControllerUserDataBase::lookForSpecificUser($getParameters["key"]);
            $controllerUser = new ControllerUserDataBase($user);
            $user->setLastName($_POST['last_name']);
            $user->setFirstName($_POST['first_name']);
            $user->setStudentNumber($_POST['student_number']);
            $user->setPassword('Az12@4567');
            $date = new datetime($_POST['date']);
            $date = $date->format("Y-m-d");
            $user->setDate($date);
            $user->setMail($_POST['mail']);
            $controllerUser->modifyUser();
        }
        $this->handleRequest($getParameters);
    }

    public function addEtudiant($getParameters)
    {
        $date = new datetime($_POST['date']);
        $date = $date->format("Y-m-d");
        $user = new User(4, 'Az12@4567', $_POST['first_name'], $_POST['last_name'], $_POST['mail'], $date, 'ETUDIANT', $_POST['student_number']);
        $controllerUser = new ControllerUserDataBase($user);
        $controllerUser->commit();
        $this->handleRequest($getParameters);
    }
}
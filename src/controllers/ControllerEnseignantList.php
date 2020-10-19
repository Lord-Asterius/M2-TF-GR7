<?php

include_once(dirname(__FILE__) . "/../views/ViewEnseignantList.php");
include_once(dirname(__FILE__) . "/../database/ControllerDataBase.php");
include_once(dirname(__FILE__) . "/../database/ControllerUserDataBase.php");

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
        $enseignants = ControllerUserDataBase::lookForAllTeacher();

        $tab = array();
        foreach ($enseignants as $enseignant) {
            $tab[$enseignant->getId()] = $enseignant->getFirstName() . ' ' . $enseignant->getLastName();
        }
        $this->m_viewEnseignantList->setEnseignantList($tab);
        $this->m_viewEnseignantList->render();
    }

    public function deleteEnseignant($getParameters)
    {
        $enseignants = ControllerUserDataBase::deleteUser($getParameters["key"]);
        $this->handleRequest($getParameters);
    }

    public function checkUserValidField()
    {
        $errorToDisplay = "";

        if (count(User::isPasswordValid($_POST['password'])) != 0 && strlen($_POST['password']) > 0)
        {
            $errorToDisplay = $errorToDisplay . "Mot de pass : min 8 caracteres; au moins un nombre, une majuscule, minuscule et un caractere spécial.\n";
        }

        if (!(preg_match("/[a-zA-Z]/", $_POST['last_name']) && preg_match("/[a-zA-Z]/", $_POST['first_name']))) {
            $errorToDisplay = $errorToDisplay . "Le nom et prénom de l'utilisateurs doivent contenir uniquement des lettres\n";
        }

        return $errorToDisplay;
    }

    public function redirectModif($error, $id)
    {
        if ($error != "") {
            Utils::redirectTo(PAGE_ID_ENSEIGNANT_EDIT, ["add" => false, "key" => $id, "error" => $error]);
        }
    }

    public function redirectAdd($error)
    {
        if ($error != "") {
            Utils::redirectTo(PAGE_ID_ENSEIGNANT_EDIT, ["add" => true, "error" => $error]);
        }
    }


    public function modifyAdminEnseignant($getParameters)
    {
        $error = $this->checkUserValidField();
        $this->redirectModif($error, $getParameters['key']);
        if ($getParameters["key"])
        {
            $user = ControllerUserDataBase::lookForSpecificUser($getParameters["key"]);
            $controllerUser = new ControllerUserDataBase($user);
            $user->setLastName($_POST['last_name']);
            $user->setFirstName($_POST['first_name']);
            $date = new datetime($_POST['date']);
            $date = $date->format("Y-m-d");
            $user->setDate($date);
            $user->setMail($_POST['mail']);

            if (strlen($_POST["password"]) != 0)
            {
                $user->setPassword($_POST['password']);
                $controllerUser->modifyUser();
            }
            else
            {
                $controllerUser->modifyUserKeepPassword();
            }
        }
        $this->handleRequest($getParameters);
    }

    public function addEnseignant($getParameters)
    {
        $error = $this->checkUserValidField();
        $this->redirectAdd($error);


        $date = new datetime($_POST['date']);
        $date = $date->format("Y-m-d");
        $user = new User(4, $_POST['password'], $_POST['first_name'], $_POST['last_name'], $_POST['mail'], $date, 'ENSEIGNANT', 0);
        $controllerUser = new ControllerUserDataBase($user);
        $controllerUser->commit();
        $this->handleRequest($getParameters);
    }

    public function editEnseignant($getParameters)
    {
        if (isset($getParameters["key"])) {
            $user = ControllerUserDataBase::lookForSpecificUser($getParameters["key"]);
            if ($user->getFirstName() && $user->getLastName() && $user->getDate() && $user->getMail()) {
                $tab = array();
                $tab['first_name'] = $user->getFirstName();
                $tab['last_name'] = $user->getLastName();
                $user->setId();
                $date = new datetime($user->getDate());
                $date = $date->format("d/m/Y");
                $tab['date'] = $date;
                $tab['mail'] = $user->getMail();

                $this->m_viewEnseignantEdit->setDataEnseignantEdit($tab);
            }
        }
        $this->m_viewEnseignantEdit->render($getParameters);
    }
}

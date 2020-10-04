<?php

include_once(dirname(__FILE__) . "/../globals/PageIdentifiers.php");
include_once(dirname(__FILE__) . "/../globals/Utils.php");
include_once(dirname(__FILE__) . "/../views/ViewModule.php");


class ControllerModuleEnrolledInformation
{
    public function __construct($_name, $_userId, $_absenceCount)
    {
        $this->name = $_name;
        $this->userId = $_userId;
        $this->absenceCount = $_absenceCount;
    }

    public $name;
    public $userId;
    public $absenceCount;
}

class ControllerModule
{
    private $m_viewModule;
    private $m_moduleName;

    public function __construct()
    {
        $this->m_viewModule = new ViewModule();
    }

    public function handleRequest($getParameters)
    {
        //TODO

        if (!isset($getParameters["module"]) || !is_string($getParameters["module"]))
        {
            // Invalid get parameter, we stop the processing
            Utils::redirectTo(PAGE_ID_MODULE_LIST, []);
        }

        // TODO Check if module exists, redirect if it's not the case
        $this->m_moduleName = $getParameters["module"];

        if (isset($getParameters["action"]) && $getParameters["action"] === "addAbsence")
        {
            $this->handleActionAddAbsence($getParameters);
        }
        else
        {
            $this->renderModule($getParameters);
        }
    }

    public function handleActionAddAbsence($getParameters)
    {
        // TODO Check if the user has the rights to add an absence in this module

        if (!isset($getParameters["absenceDate"]) || !isset($getParameters["absenceTime"]) ||
            !isset($getParameters["reason"]) || !isset($getParameters["userId"]))
        {
            Utils::redirectTo(PAGE_ID_MODULE, ["module" => $this->m_moduleName, "error" => "Impossible d'ajouter l'absence : formulaire invalide"]);
        }

        if(!preg_match("/^\d\d\/\d\d\/\d\d\d\d$/", $getParameters["absenceDate"]))
        {
            Utils::redirectTo(PAGE_ID_MODULE, ["module" => $this->m_moduleName, "error" => "Impossible d'ajouter l'absence : format de la date invalide"]);
        }

        if(!preg_match("/^\d\d:\d\d$/", $getParameters["absenceTime"]))
        {
            Utils::redirectTo(PAGE_ID_MODULE, ["module" => $this->m_moduleName, "error" => "Impossible d'ajouter l'absence : format de l'heure invalide"]);
        }

        if (!ctype_digit($getParameters["userId"]))
        {
            Utils::redirectTo(PAGE_ID_MODULE, ["module" => $this->m_moduleName, "error" => "Impossible d'ajouter l'absence : l'identifiant de l'utilisateur n'est pas un entier"]);
        }

        // TODO Check that userId is valid and registered in this module, insert in the database

        $userName = "Nom";
        $date = $getParameters['absenceDate'];
        $time =  $getParameters['absenceTime'];
        $reason = $getParameters["reason"];

        $successMessage = "Absence ajoutée pour $userName à la date du $date à $time avec le motif \"$reason\"";

        Utils::redirectTo(PAGE_ID_MODULE, ["module" => $this->m_moduleName, "success" => $successMessage]);
    }

    public function renderModule($getParameters)
    {
        $this->m_viewModule->setModuleName($getParameters["module"]);

        // TODO Retrieve users from the database
        $fakeData = [new ControllerModuleEnrolledInformation("Fabrice Bouquet", 4, 0),
                     new ControllerModuleEnrolledInformation("Fabien Peureux", 2, 3),
                     new ControllerModuleEnrolledInformation("Jean Dupont", 8, 1),];

        $this->m_viewModule->setEnrolledUsers($fakeData);

        // TODO Retrieve rights from the session
        $this->m_viewModule->setHasEditRights(true);

        if (isset($getParameters["success"]))
        {
            $this->m_viewModule->setSuccessToast($getParameters["success"]);
        }
        elseif (isset($getParameters["error"]))
        {
            $this->m_viewModule->setErrorToast($getParameters["error"]);
        }

        $this->m_viewModule->render();
    }
}
<?php

include_once(dirname(__FILE__) . "/../globals/PageIdentifiers.php");
include_once(dirname(__FILE__) . "/../globals/Utils.php");
include_once(dirname(__FILE__) . "/../views/ViewModule.php");
include_once(dirname(__FILE__) . "/../database/ControllerModuleDataBase.php");
include_once(dirname(__FILE__) . "/../database/ControllerUserDataBase.php");


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
    private $m_moduleInfo;

    public function __construct()
    {
        $this->m_viewModule = new ViewModule();
    }

    public function handleRequest($getParameters)
    {
        ControllerDataBase::connectToDatabase();

        if (!isset($getParameters["module"]) || !is_string($getParameters["module"]))
        {
            // Invalid get parameter, we stop the processing
            Utils::redirectTo(PAGE_ID_MODULE_LIST, []);
        }

        $this->m_moduleName = $getParameters["module"];
        $this->m_moduleInfo = ControllerModuleDataBase::lookForModule($this->m_moduleName);

        if ($this->m_moduleInfo === false)
        {
            // Module not found, we stop the processing
            Utils::redirectTo(PAGE_ID_MODULE_LIST, []);
        }

        if ($_SESSION['role'] != "ADMINISTRATEUR")
        {
            $isInModule = false;

            foreach ($_SESSION['user']->getModule() as $module)
            {
                if ($module->getName() == $this->m_moduleName)
                {
                    $isInModule = true;
                    break;
                }
            }

            if ($isInModule === false)
            {
                // User not authorized to access this module
                Utils::redirectTo(PAGE_ID_MODULE_LIST, []);
            }
        }

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

        if(!preg_match("/^\d\d\d\d\/\d\d\/\d\d\$/", $getParameters["absenceDate"]))
        {
            Utils::redirectTo(PAGE_ID_MODULE, ["module" => $this->m_moduleName, "error" => "Impossible d'ajouter l'absence : format de la date invalide"]);
        }

        if(!preg_match("/^\d\d:\d\d$/", $getParameters["absenceTime"]))
        {
            Utils::redirectTo(PAGE_ID_MODULE, ["module" => $this->m_moduleName, "error" => "Impossible d'ajouter l'absence : format de l'heure invalide"]);
        }

        // TODO Check that userId is valid and registered in this module, insert in the database

        $user = ControllerUserDataBase::lookForSpecificUser($getParameters["userId"]);
        $userController = new ControllerUserDataBase($user);

        if ($user == null)
        {
            Utils::redirectTo(PAGE_ID_MODULE, ["module" => $this->m_moduleName, "error" => "Impossible d'ajouter l'absence : user id invalide"]);
        }

        $userName = $user->getFirstName() . " " . $user->getLastName();
        $date = str_replace("/", "-", $getParameters['absenceDate']);
        $time =  $getParameters['absenceTime'] . ":00";
        $reason = $getParameters["reason"];

        $absence = new Absence(null, $reason, "", $date . " " . $time);
        $userController->addAbsence($absence);

        $successMessage = "Absence ajoutée pour $userName à la date du $date à $time avec le motif \"$reason\"";

        Utils::redirectTo(PAGE_ID_MODULE, ["module" => $this->m_moduleName, "success" => $successMessage]);
    }

    public function renderModule($getParameters)
    {
        $this->m_viewModule->setModuleName($this->m_moduleName);

        $enrolledUsersInformation = [];

        $enrolledUsers = ControllerUserDataBase::lookForAllStudentInModule($this->m_moduleName);

        foreach ($enrolledUsers as $user)
        {
            $user = ControllerUserDataBase::lookForSpecificUser($user->getId());
            $enrolledUsersInformation[] = new ControllerModuleEnrolledInformation($user->getFirstName() . " " . $user->getLastName(),
                                                                                  $user->getId(), count($user->getAbsence()));
        }

        $this->m_viewModule->setEnrolledUsers($enrolledUsersInformation);

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
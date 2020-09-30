<?php

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
            return;
        }

        $this->m_viewModule->setModuleName($getParameters["module"]);

        // TODO Retrieve users from the database
        $fakeData = [new ControllerModuleEnrolledInformation("Fabrice Bouquet", 4, 0),
                     new ControllerModuleEnrolledInformation("Fabien Peureux", 2, 3),
                     new ControllerModuleEnrolledInformation("Jean Dupont", 8, 1),];

        $this->m_viewModule->setEnrolledUsers($fakeData);

        // TODO Retrieve rights from the session
        $this->m_viewModule->setHasEditRights(true);
        $this->m_viewModule->render();
    }
}
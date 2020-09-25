<?php

include_once(dirname(__FILE__) . "/../views/ViewModule.php");


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
        $this->m_viewModule->setEnrolledUsers(["Fabrice Bouquet", "Fabien Peureux", "Autre personne"]);
        $this->m_viewModule->render();
    }
}
<?php

include_once(dirname(__FILE__) . "/../views/ViewModuleList.php");
include_once(dirname(__FILE__) . "/../database/ControllerModuleDataBase.php");


class ControllerModuleList
{
    private $m_viewModuleList;

    public function __construct()
    {
        $this->m_viewModuleList = new ViewModuleList();
    }

    public function handleRequest($getParameters)
    {
        ControllerDataBase::connectToDatabase();

        $moduleNames = [];
        $modules = ControllerModuleDataBase::lookForAllModule();

        foreach ($modules as $module)
        {
            $moduleNames[] = $module->getName();
        }

        $this->m_viewModuleList->setModulesNamesList($moduleNames);
        $this->m_viewModuleList->render();
    }
}
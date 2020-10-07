<?php

include_once(dirname(__FILE__) . "/../views/ViewAdminModuleList.php");
include_once(dirname(__FILE__) . "/../views/ViewAdminModuleEdit.php");
include_once(dirname(__FILE__) . "/../database/ControllerDataBase.php");
include_once(dirname(__FILE__) . "/../database/ControllerModuleDataBase.php");
include_once(dirname(__FILE__) . '/../database/Module.php');



//todo renommé classe en ControlleAdminModule tout silmple 

class ControllerAdminModuleList
{
    private $m_viewAdminModuleList;
    private $m_ViewAdminModuleEdit;

    public function __construct()
    {
        $this->m_viewAdminModuleList = new ViewAdminModuleList();
        $this->m_ViewAdminModuleEdit = new ViewAdminModuleEdit();

    }

    public function handleRequest($getParameters)
    {
        ControllerDataBase::connectToDatabase();
        $modules =ControllerModuleDataBase::lookForAllModule();
        $modulesName=array();
        foreach($modules as $module){
            array_push($modulesName,$module->getName());
        }
        $this->m_viewAdminModuleList->setModulesNamesList($modulesName);
        $this->m_viewAdminModuleList->render();
    }

    public function deleteModule($getParameters){
        ControllerDataBase::connectToDatabase();
        ControllerModuleDataBase::deleteModule($getParameters["module"]);
        $this->handleRequest($getParameters);
    }
    public function editModule($getParameters){
        $this->m_ViewAdminModuleEdit->render();
    }
    
    public function addAdminModule($getParameters){
        ControllerDataBase::connectToDatabase();
        $module= new Module(1,$_POST['moduleName']);
        $controllerModule = new ControllerModuleDataBase($module);
        $controllerModule->commit();
        $this->handleRequest($getParameters);
    }


}
<?php

include_once(dirname(__FILE__) . "/../views/ViewAdminModuleEdit.php");


class ControllerAdminModuleEdit
{
    private $m_ViewAdminModuleEdit;
    private $m_ViewAdminModuleList;

    public function __construct()
    {
        $this->m_ViewAdminModuleEdit = new ViewAdminModuleEdit();
    }

    public function handleRequest($getParameters)
    {
        // $this->m_ViewAdminModuleEdit->setModuleEdit(["Dupont Jean", "Emilie", "Alexandre"]);
        $this->m_ViewAdminModuleEdit->render();
    }
    // public function addAdminModule($getParameters){
    //     $moduleName = $_POST['moduleName'];
    //     ControllerDataBase::connectToDatabase();
    //     $modules =ControllerModuleDataBase::addModule($moduleName);
    //     $this->handleRequest($getParameters);
    // }

}
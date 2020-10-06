<?php

include_once(dirname(__FILE__) . "/GlobalCanvas.php");


class ViewAdminModuleList
{
    private $m_canvas;
    private $m_context;

    public function __construct()
    {
        $this->m_canvas = new GlobalCanvas("Module admin", PAGE_ID_ADMIN_MODULE_LIST);
        $this->m_context = [];

    }
    public function setModulesNamesList($modulesNames)
    {
        $this->m_context["modulesNames"] = $modulesNames;
    }

    // public function setModuleName($moduleName)
    // {
    //     $this->m_context["moduleName"] = $moduleName;
    // }

    public function render()
    {
        $this->m_canvas->renderTemplate("adminModuleList", $this->m_context);
    }

    
}
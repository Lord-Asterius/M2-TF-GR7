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

        $this->m_context["toastSuccess"] = false;
        $this->m_context["toastError"] = false;
    }

    public function setErrorToast($message)
    {
        $this->m_context["toastError"] = true;
        $this->m_context["toastMessage"] = $message;
    }

    public function setModulesNamesList($modulesNames)
    {
        $this->m_context["modulesNames"] = $modulesNames;
    }


    public function render()
    {

        $this->m_canvas->renderTemplate("adminModuleList", $this->m_context);
    }

    
}
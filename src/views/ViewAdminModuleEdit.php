<?php

include_once(dirname(__FILE__) . "/GlobalCanvas.php");


class ViewAdminModuleEdit
{
    private $m_canvas;
    private $m_context;

    public function __construct()
    {
        $this->m_canvas = new GlobalCanvas("Edition d'un module", PAGE_ID_MODULE_EDIT);
        $this->m_context = [];
    }

    public function setModuleEdit($module)
    {
        $this->m_context["module"] = $module;
    }
    public function setErrorToast($message)
    {
        $this->m_context["toastError"] = true;
        $this->m_context["toastMessage"] = $message;
    }

    public function render($getParameters)
    {
        if (isset($getParameters["error"])) {
            $this->setErrorToast($getParameters["error"]);
        }
        $this->m_canvas->renderTemplate("moduleEdit", $this->m_context);
    }
}
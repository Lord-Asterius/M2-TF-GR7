<?php

include_once(dirname(__FILE__) . "/GlobalCanvas.php");


class ViewModule
{
    private $m_canvas;
    private $m_context;

    public function __construct()
    {
        $this->m_canvas = new GlobalCanvas("Module", PAGE_ID_MODULE);
        $this->m_context = [];

        $this->m_context["toastSuccess"] = false;
        $this->m_context["toastError"] = false;
    }

    public function setModuleName($moduleName)
    {
        $this->m_context["moduleName"] = $moduleName;
    }

    public function setHasEditRights($hasEditRights)
    {
        $this->m_context["hasEditRights"] = $hasEditRights;
    }

    public function setEnrolledUsers($enrolledUsers)
    {
        $this->m_context["enrolledUsers"] = $enrolledUsers;
    }

    public function setSuccessToast($message)
    {
        $this->m_context["toastSuccess"] = true;
        $this->m_context["toastMessage"] = $message;
    }

    public function setErrorToast($message)
    {
        $this->m_context["toastError"] = true;
        $this->m_context["toastMessage"] = $message;
    }

    public function render()
    {
        $this->m_canvas->renderTemplate("module", $this->m_context);
    }

    
}

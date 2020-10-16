<?php

include_once(dirname(__FILE__) . "/GlobalCanvas.php");


class ViewAdministration
{
    private $m_canvas;
    private $m_context;

    public function __construct()
    {
        $this->m_canvas = new GlobalCanvas("Page administration", PAGE_ID_ADMINISTRATION);
        $this->m_context = [];

        $this->m_context["toastSuccess"] = false;
        $this->m_context["toastError"] = false;
    }


    public function setSuccessToast()
    {
        $this->m_context["toastSuccess"] = true;
        $this->m_context["toastMessage"] = "Succès";
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
        } else {
            $this->setSuccessToast();
        }

        $this->m_canvas->renderTemplate("administration", $this->m_context);
    }
}
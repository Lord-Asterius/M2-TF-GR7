<?php

include_once(dirname(__FILE__) . "/GlobalCanvas.php");


class ViewEtudiantEdit
{
    private $m_canvas;
    private $m_context;

    public function __construct()
    {
        $this->m_canvas = new GlobalCanvas("Edition d'un étudiant", PAGE_ID_ETUDIANT_EDIT);
        $this->m_context = [];
        $this->m_context["toastSuccess"] = false;
        $this->m_context["toastError"] = false;
    }

    public function setErrorToast($message)
    {
        $this->m_context["toastError"] = true;
        $this->m_context["toastMessage"] = $message;
    }


    public function setDataEtudiantEdit($etudiant)
    {
        $this->m_context["etudiant"] = $etudiant;
    }

    public function render($getParameters)
    {
        if (isset($getParameters["error"])) {
            $this->setErrorToast($getParameters["error"]);
        }
        $this->m_canvas->renderTemplate("etudiantEdit", $this->m_context);
    }
}
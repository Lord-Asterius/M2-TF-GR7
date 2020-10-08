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
    }

    public function setDataEtudiantEdit($etudiant)
    {
        $this->m_context["etudiant"] = $etudiant;
    }

    public function render()
    {
        $this->m_canvas->renderTemplate("etudiantEdit", $this->m_context);
    }
}
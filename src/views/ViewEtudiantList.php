<?php

include_once(dirname(__FILE__) . "/GlobalCanvas.php");


class ViewEtudiantList
{
    private $m_canvas;
    private $m_context;

    public function __construct()
    {
        $this->m_canvas = new GlobalCanvas("Liste des étudiants", PAGE_ID_ETUDIANT_LIST);
        $this->m_context = [];
    }

    public function setEtudiantList($etudiants)
    {
        $this->m_context["etudiants"] = $etudiants;
    }

    public function render()
    {

        $this->m_canvas->renderTemplate("etudiantList", $this->m_context);
    }
}
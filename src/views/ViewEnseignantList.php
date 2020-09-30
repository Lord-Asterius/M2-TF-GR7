<?php

include_once(dirname(__FILE__) . "/GlobalCanvas.php");


class ViewEnseignantList
{
    private $m_canvas;
    private $m_context;

    public function __construct()
    {
        $this->m_canvas = new GlobalCanvas("Liste des enseignants", PAGE_ID_ENSEIGNANT_LIST);
        $this->m_context = [];
    }

    public function setEnseignantList($etudiants)
    {
        $this->m_context["enseignants"] = $etudiants;
    }

    public function render()
    {
        $this->m_canvas->renderTemplate("enseignantList", $this->m_context);
    }
}
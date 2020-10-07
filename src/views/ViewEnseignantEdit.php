<?php

include_once(dirname(__FILE__) . "/GlobalCanvas.php");


class ViewEnseignantEdit
{
    private $m_canvas;
    private $m_context;

    public function __construct()
    {
        $this->m_canvas = new GlobalCanvas("Edition d'un enseignant", PAGE_ID_ENSEIGNANT_EDIT);
        $this->m_context = [];
    }

    public function setEnseignantEdit($enseignant)
    {
        $this->m_context["enseignant"] = $enseignant;
    }
    public function setDataEnseignantEdit($enseignant)
    {
        $this->m_context["enseignant"] = $enseignant;
    }

    public function render()
    {
        $this->m_canvas->renderTemplate("enseignantEdit", $this->m_context);
    }
}
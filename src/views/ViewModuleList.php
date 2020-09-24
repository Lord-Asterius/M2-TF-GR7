<?php

include_once(dirname(__FILE__) . "/GlobalCanvas.php");


class ViewModuleList
{
    private $m_canvas;
    private $m_context;

    public function __construct()
    {
        $this->m_canvas = new GlobalCanvas("Liste des modules");
        $this->m_context = [];
    }

    public function render()
    {
        $this->m_canvas->renderTemplate("moduleList", $this->m_context);
    }
}
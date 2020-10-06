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
    }


    public function render()
    {
        $this->m_canvas->renderTemplate("administration", $this->m_context);
    }
}
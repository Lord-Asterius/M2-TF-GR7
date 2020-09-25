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
    }

    public function render()
    {
        $this->m_canvas->renderTemplate("module", $this->m_context);
    }
}
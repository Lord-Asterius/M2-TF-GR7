<?php

include_once(dirname(__FILE__) . "/GlobalCanvas.php");


class ViewHome
{
    private $m_canvas;

    public function __construct()
    {
        $this->m_canvas = new GlobalCanvas("Bienvenu !", PAGE_ID_HOME);
    }

    public function render()
    {
        $context = [];
        $this->m_canvas->renderTemplate("home", $context);
    }
}
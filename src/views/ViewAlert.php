<?php

include_once(dirname(__FILE__) . "/GlobalCanvas.php");

class ViewAlert
{
    private $a_canvas;
    private $a_context;

    public function __construct()
    {
        $this->a_canvas = new GlobalCanvas("Liste des alertes", PAGE_ID_ALERT);
        $this->a_context = [];
    }

    public function setAlertList($alert)
    {
        $this->a_context["alert"] = $alert;;
    }
    public function render()
    {
        $this->a_canvas->renderTemplate("alert", $this->a_context);
    }
}
<?php

include_once(dirname(__FILE__) . "/GlobalCanvas.php");


class ViewConnection
{
    private $c_canvas;
    private $c_context;

    public function __construct()
    {
        $this->c_canvas = new GlobalCanvas("Connexion", PAGE_ID_CONNECTION);
        $this->c_context["ErrorLogIn"] = false;
    }

    public function setErrorLogIn()
    {
        $this->c_context["ErrorLogIn"] = true;
    }


    public function render()
    {
        $this->c_canvas->renderTemplate("connection", $this->c_context);
    }
}

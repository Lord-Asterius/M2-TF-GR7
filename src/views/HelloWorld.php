<?php

include (dirname(__FILE__) . "/GlobalCanvas.php");


class HelloWorld
{
    private $m_canvas;

    public function __construct()
    {
        $this->m_canvas = new GlobalCanvas("Hello world page !");
    }

    public function render()
    {
        $context = ["textFromCode" => "This text was set from the context in PHP code"];
        $this->m_canvas->renderTemplate(dirname(__FILE__) . "/../templates/helloWorld.html", $context);
    }
}
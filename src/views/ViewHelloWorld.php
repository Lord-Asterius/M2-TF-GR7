<?php

include_once(dirname(__FILE__) . "/GlobalCanvas.php");


class ViewHelloWorld
{
    private $m_canvas;

    public function __construct()
    {
        $this->m_canvas = new GlobalCanvas("Hello world page !", PAGE_ID_HELLO_WORLD);
    }

    public function render()
    {
        $context = ["textFromCode" => "This text was set from the context in PHP code"];
        $this->m_canvas->renderTemplate("helloWorld", $context);
    }
}
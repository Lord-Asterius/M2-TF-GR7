<?php

include_once(dirname(__FILE__) . "/../views/ViewModule.php");


class ControllerModule
{
    private $m_viewModule;

    public function __construct()
    {
        $this->m_viewModule = new ViewModule();
    }

    public function handleRequest($getParameters)
    {
        //TODO
        $this->m_viewModule->render();
    }
}
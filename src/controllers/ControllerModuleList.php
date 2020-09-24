<?php

include_once(dirname(__FILE__) . "/../views/ViewModuleList.php");


class ControllerModuleList
{
    private $m_viewModuleList;

    public function __construct()
    {
        $this->m_viewModuleList = new ViewModuleList();
    }

    public function handleRequest($getParameters)
    {
        //TODO
        $this->m_viewModuleList->render();
    }
}
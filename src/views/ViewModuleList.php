<?php

include_once(dirname(__FILE__) . "/GlobalCanvas.php");


class ViewModuleList
{
    private $m_canvas;
    private $m_context;

    public function __construct()
    {
        $this->m_canvas = new GlobalCanvas("Liste des modules", PAGE_ID_MODULE_LIST);
        $this->m_context = [];
    }

    public function setModulesNamesList($modulesNames)
    {
        $this->m_context["modulesNames"] = $modulesNames;
    }

    public function render()
    {
        $this->m_canvas->renderTemplate("moduleList", $this->m_context);
    }
}
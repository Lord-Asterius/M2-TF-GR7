<?php

include_once(dirname(__FILE__) . "/GlobalCanvas.php");


class ViewAdminModuleMenuSubscibe
{
    private $m_canvas;
    private $m_context;

    public function __construct()
    {
        $this->m_canvas = new GlobalCanvas("Page inscriptions au module", PAGE_ID_ADMIN_MODULE_SUBSCRIBE_MENU);
        $this->m_context = [];
    }


    public function render()
    {
        $this->m_canvas->renderTemplate("adminModuleInscriptionMenu", $this->m_context);
    }

    public function setModule($module){
        $this->m_context["module"] = $module;
    }
}
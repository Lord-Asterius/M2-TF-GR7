<?php

include_once(dirname(__FILE__) . "/GlobalCanvas.php");


class ViewAdminEnseignantList
{
    private $m_canvas;
    private $m_context;

    public function __construct()
    {
        $this->m_canvas = new GlobalCanvas("Enseignant admin", PAGE_ID_ADMIN_ENSEIGNANT_LIST);
        $this->m_context = [];

    }
    public function setEnseignantsNamesList($enseignantsNames)
    {
        $this->m_context["enseignantsNames"] = $enseignantsNames;
    }

    // public function setEnseignantName($enseignantName)
    // {
    //     $this->m_context["enseignantName"] = $enseignantName;
    // }

    public function render()
    {
        $this->m_canvas->renderTemplate("adminEnseignantList", $this->m_context);
    }

    
}
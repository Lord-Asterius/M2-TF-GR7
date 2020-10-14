<?php

include_once(dirname(__FILE__) . "/GlobalCanvas.php");


class ViewAdminModuleInscriptionEnseignants
{
    private $m_canvas;
    private $m_context;

    public function __construct()
    {
        $this->m_canvas = new GlobalCanvas("Ajouter des enseignants au module", PAGE_ID_ADMIN_MODULE_INSCRIPTION_ENSEIGNANTS);
        $this->m_context = [];
    }

    public function render()
    {
        $this->m_canvas->renderTemplate("adminModuleInscriptionEnseignants", $this->m_context);
    }
    
    public function setEnseignantList($enseignants){
        $this->m_context["enseignants"] = $enseignants;
    }
}
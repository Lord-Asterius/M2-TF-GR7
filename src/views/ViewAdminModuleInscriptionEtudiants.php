<?php

include_once(dirname(__FILE__) . "/GlobalCanvas.php");


class ViewAdminModuleInscriptionEtudiants
{
    private $m_canvas;
    private $m_context;

    public function __construct()
    {
        $this->m_canvas = new GlobalCanvas("Ajouter des etudiants au module", PAGE_ID_ADMIN_MODULE_INSCRIPTION_ETUDIANTS);
        $this->m_context = [];
    }

    public function render()
    {
        $this->m_canvas->renderTemplate("adminModuleInscriptionEtudiants", $this->m_context);
    }
    
    public function setEtudiantList($etudiants){
        $this->m_context["etudiants"] = $etudiants;
    }
}
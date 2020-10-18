<?php

include_once(dirname(__FILE__) . "/GlobalCanvas.php");


class ViewAdminModuleInscriptionEnseignantsRef
{
    private $m_canvas;
    private $m_context;

    public function __construct()
    {
        $this->m_canvas = new GlobalCanvas("Ajouter des enseignants réferents au module", PAGE_ID_ADMIN_MODULE_INSCRIPTION_ENSEIGNANTS_REFERENTS);
        $this->m_context = [];
    }

    public function render()
    {
        $this->m_canvas->renderTemplate("adminModuleInscriptionEnseignantsRef", $this->m_context);
    }
    
    public function setEnseignantList($enseignantsRef){
        $this->m_context["enseignantsRef"] = $enseignantsRef;
    }
}
<?php

include_once(dirname(__FILE__) . "/../views/ViewEtudiantEdit.php");


class ControllerEtudiantEdit
{
    private $m_viewEtudiantEdit;

    public function __construct()
    {
        $this->m_viewEtudiantEdit = new ViewEtudiantEdit();
    }

    public function handleRequest($getParameters)
    {
                    // $this->m_viewEtudiantEdit->setEtudiantEdit(["Dupont Jean", "Emilie", "Alexandre"]);
                    $this->m_viewEtudiantEdit->render();
}
}
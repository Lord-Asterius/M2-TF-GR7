<?php

include_once(dirname(__FILE__) . "/../views/ViewEnseignantEdit.php");


class ControllerEnseignantEdit
{
    private $m_viewEnseignantEdit;

    public function __construct()
    {
        $this->m_viewEnseignantEdit = new ViewEnseignantEdit();
    }

    public function handleRequest($getParameters)
    {
                    // $this->m_viewEnseignantEdit->setEnseignantEdit(["Dupont Jean", "Emilie", "Alexandre"]);
                    $this->m_viewEnseignantEdit->render();
}
}
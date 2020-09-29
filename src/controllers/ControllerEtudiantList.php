<?php

include_once(dirname(__FILE__) . "/../views/ViewEtudiantList.php");


class ControllerEtudiantList
{
    private $m_viewEtudiantList;

    public function __construct()
    {
        $this->m_viewEtudiantList = new viewEtudiantList();
    }

    public function handleRequest($getParameters)
    {
                    $this->m_viewEtudiantList->setEtudiantList(["Dupont Jean", "Emilie", "Alexandre"]);
                    $this->m_viewEtudiantList->render();
}
}
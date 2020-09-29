<?php

include_once(dirname(__FILE__) . "/../views/ViewEnseignantList.php");


class ControllerEnseignantList
{
    private $m_viewEnseignantList;

    public function __construct()
    {
        $this->m_viewEnseignantList = new viewEnseignantList();
    }

    public function handleRequest($getParameters)
    {
                    print_r($getParameters);
                    $this->m_viewEnseignantList->setEnseignantList(["Dupont Jean", "Emilie", "Alexandre"]);
                    $this->m_viewEnseignantList->render();
}
}
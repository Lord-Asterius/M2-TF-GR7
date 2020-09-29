<?php

include_once(dirname(__FILE__) . "/../views/ViewConnection.php");


class ControllerConnection
{
    private $c_viewConnection;

    public function __construct()
    {
        $this->c_viewConnection= new ViewConnection();
    }

    public function connection($getParameters)
    {

        $this->c_viewConnection->render();
    }
}
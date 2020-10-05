<?php

include_once(dirname(__FILE__) . "/../views/ViewConnection.php");
include_once(dirname(__FILE__) . "/../database/ControllerDataBase.php");
include_once(dirname(__FILE__) . "/../database/ControllerUserDataBase.php");
include_once(dirname(__FILE__) . "/../globals/Utils.php");

class ControllerConnection
{
    private $c_viewConnection;

    public function __construct()
    {
        $this->c_viewConnection= new ViewConnection();
        $_SESSION['tryConnection'] = false;
    }

    public function connection($getParameters)
    {
        if(isset($_POST['username']) && isset($_POST['password'])){
            $username = $_POST['username'];
            $password = $_POST['password'];
            ControllerDataBase::connectToDatabase();
            $_SESSION['user'] = ControllerUserDataBase::lookForSpecificUser($username);
            if($_SESSION['user']->isSamePassword($password)){
                if(isset($_SESSION['user'])){
                    switch($_SESSION['user']['role']){
                        case 'ENSEIGNANT':
                        case 'ETUDIANT':
                            Utils::redirectTo(PAGE_ID_MODULE_LIST, []);
                            break;
                        //                    case 'EQUIPE_ADMINISTRATIVE':
                        //                        Utils::redirectTo(PAGE_ID_, []);
                        //                        break;
                        //                    case 'ADMINISTRATEUR' :
                        //                        Utils::redirectTo(PAGE_ID_, []);
                        //                        break;
                    }
                }
            }else{

            }
        }
        $this->c_viewConnection->render();
    }
}
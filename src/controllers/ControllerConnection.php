<?php

include_once(dirname(__FILE__) . "/../views/ViewConnection.php");
include_once(dirname(__FILE__) . "/../database/ControllerDataBase.php");
include_once(dirname(__FILE__) . "/../database/ControllerUserDataBase.php");
include_once(dirname(__FILE__) . "/../globals/Utils.php");
include_once(dirname(__FILE__) . '/../database/User.php');
include_once(dirname(__FILE__) . '/../database/Module.php');
include_once(dirname(__FILE__) . '/../database/Absence.php');

class ControllerConnection
{
    private $c_viewConnection;

    public function __construct()
    {
        $this->c_viewConnection = new ViewConnection();
    }

    public function connection()
    {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            ControllerDataBase::connectToDatabase();
            if ($_SESSION['user'] = ControllerUserDataBase::lookForSpecificUser($username)) {
                if ($_SESSION['user']->isSamePassword($password)) {
                    $_SESSION['role'] = $_SESSION['user']->getRole();
                    switch ($_SESSION['user']->getRole()) {
                        case 'ENSEIGNANT':
                            Utils::redirectTo(PAGE_ID_MODULE_LIST, []);
                            break;
                        case 'ETUDIANT':
                            $this->c_viewConnection->setErrorLogIn();
                            Utils::redirectTo(PAGE_ID_CONNECTION, []);
                            break;
                        //                        break;
                        //                    case 'EQUIPE_ADMINISTRATIVE':
                        //                        Utils::redirectTo(PAGE_ID_, []);
                        //                        break;
                        //                    case 'ADMINISTRATEUR' :
                        //                        Utils::redirectTo(PAGE_ID_, []);
                        //                        break;
                    }
                } else {
                    $this->c_viewConnection->setErrorLogIn();
                }
            } else {
                $this->c_viewConnection->setErrorLogIn();
            }
        }
        $this->c_viewConnection->render();
    }
}
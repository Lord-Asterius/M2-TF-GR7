<?php

include_once(dirname(__FILE__) . "/../views/ViewAlert.php");
include_once(dirname(__FILE__) . "/../database/ControllerDataBase.php");
include_once(dirname(__FILE__) . "/../database/ControllerUserDataBase.php");
include_once(dirname(__FILE__) . "/../globals/Utils.php");
include_once(dirname(__FILE__) . '/../database/User.php');
include_once(dirname(__FILE__) . '/../database/Module.php');
include_once(dirname(__FILE__) . '/../database/Absence.php');


class ControllerAlert
{
    private $m_viewAlert;

    public function __construct()
    {
        $this->m_viewAlert = new ViewAlert();
    }

    public function handleRequest()
    {
        ControllerDataBase::connectToDatabase();
        $students = ControllerUserDataBase::lookForAllStudents();
        $alerts = array();
        foreach ($students as $student){
            $nbAbsence = 0;
            foreach ($student->getAbsence() as $absence){
                if(!preg_match("/[a-zA-Z]/", $absence->getReason())){
                    $nbAbsence ++;
                }
            }
            if($nbAbsence >= 3){
                $alerts[$student->getKey()] = array($student->getKey(), $student->getFirstName(), $student->getLastName(), $nbAbsence, $student->getMail(), $student->getStudentNumber());
            }
        }
        $this->m_viewAlert->setAlertList($alerts);
        $this->m_viewAlert->render();
    }
}
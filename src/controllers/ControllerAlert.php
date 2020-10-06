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
        foreach ($students as $student){
            $nbAbsence = 0;
            foreach ($student->getAbsence() as $absence){
                if(!preg_match("/[a-zA-Z]/", $absence->getReason())){
                    $nbAbsence ++;
                }
            }
            echo $nbAbsence;
            var_dump($student);
            if($nbAbsence >= 3){
                $alerts[$student['key']] = array($student['id'], $student['firstName'], $student['lastName'], $nbAbsence, $student['mail']);
            }
        }
        $this->m_viewAlert->setAlertList($alerts);
        $this->m_viewAlert->render();
    }
}
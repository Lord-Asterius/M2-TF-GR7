<?php

include_once(dirname(__FILE__) . "/../views/ViewAbsenseDetails.php");
include_once(dirname(__FILE__) . "/../database/ControllerAbsenceDataBase.php");


class ControllerAbsenceDetails
{
    private $m_viewAbsence;
    private $model;

    public function __construct()
    {
        $this->m_viewAbsence = new ViewAbsenceDetails();
        
    }

    public function handleRequest($getParameters)
    {  
        $studentId = $_GET['studentId'];
        $students = ControllerAbsenceDataBase::lookForSpecificUser($studentId); 
        //print_r($students);
        $this->m_viewAbsence->setAttendanceData($students);
        $this->m_viewAbsence->render();
    }



}
<?php

include_once(dirname(__FILE__) . "/../views/ViewAbsenceList.php");
include_once(dirname(__FILE__) . "/../database/User.php");


include_once(dirname(__FILE__) . "/../database/ControllerDataBase.php");
include_once(dirname(__FILE__) . "/../database/ControllerUserDataBase.php");
include_once(dirname(__FILE__) . "/../database/ControllerAbsenceDataBase.php");
include_once(dirname(__FILE__) . '/../database/Absence.php');
include_once(dirname(__FILE__) . "/../views/ViewAbsenceAdd.php");



class ControllerAbsenceList
{
    private $m_viewAbsenceList;
    private $m_viewAbsenceAdd;


    public function __construct()
    {
        $this->m_viewAbsenceList = new ViewAbsenceList();
        $this->m_viewAbsenceAdd = new  ViewAbsenceAdd();

        ControllerDataBase::connectToDatabase();
    }

    public function handleRequest($getParameters)
    {
        ControllerDataBase::connectToDatabase();

        $action = isset($getParameters["action"]) ? $getParameters["action"] : '';
        $absenceKey = isset($getParameters["absenceKey"]) ? $getParameters["absenceKey"] : '';


        switch($action) {
            case 'delete':
                $this->deleteAbsence($absenceKey);
                break;
        }

        $allStudentsName = [];
        $allStudent = ControllerAbsenceDataBase::getForAllAbsence();


        foreach ($allStudent as $student)
        {


            $allStudentsName[] = [
                                    "id" => $student["absenceKey"],
                                    "name" => $student["firstName"],
                                    "lastName" => $student["lastName"],
                                    "module" => $student["moduleName"],
                                    "date"=> $student["date"],
                                    "studentKey" => $student["studentId"]      
                                ];
        }


        $this->m_viewAbsenceList->setAttendanceData($allStudentsName);
        $this->m_viewAbsenceList->render();
    }

    public function deleteAbsence($studentId){
        ControllerDataBase::connectToDatabase();
        ControllerAbsenceDataBase::deleteAbsence($studentId);
        // $this->handleRequest($getParameters);
    }

    public function absenceEdit($getParameters){
        // $this->m_viewAbsenceAdd->render();
    }

    public function add_absence($getParameters, $postParameters){
       
        $action = isset($getParameters["action"]) ? $getParameters["action"] : '';
        $studentKey = isset($postParameters["studentKey"]) ? $postParameters["studentKey"] : NULL;
        $s_key = isset($getParameters["studentKey"]) ? $getParameters["studentKey"] : NULL;
        $date = isset($postParameters["date"]) ? $postParameters["date"] : '';
        $comment = isset($postParameters["comment"]) ? $postParameters["comment"] : '';
        $reason = isset($postParameters["reason"]) ? $postParameters["reason"] : '';
     
        switch($action) {
            case 'add':
                $res = ControllerAbsenceDataBase::insertAbsence($studentKey, $comment, $reason, $date);
               
            break;   
        }



        $allStudent = ControllerUserDataBase::lookForAllStudents();
      
        $this->m_viewAbsenceAdd->setAttendanceData($s_key, $allStudent);
        $this->m_viewAbsenceAdd->render();
    }
}
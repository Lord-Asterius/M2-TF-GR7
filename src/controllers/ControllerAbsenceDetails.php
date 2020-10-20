<?php

include_once(dirname(__FILE__) . "/../views/ViewAbsenseDetails.php");
include_once(dirname(__FILE__) . "/../database/User.php");
include_once(dirname(__FILE__) . "/../database/ControllerDataBase.php");
include_once(dirname(__FILE__) . "/../database/ControllerUserDataBase.php");
include_once(dirname(__FILE__) . "/../database/ControllerAbsenceDataBase.php");
include_once(dirname(__FILE__) . '/../database/Absence.php');
include_once(dirname(__FILE__) . "/../views/ViewAbsenceEdit.php");
include_once(dirname(__FILE__) . "/../views/ViewAbsenceAdd.php");


class ControllerAbsenceDetails
{
    private $m_viewAbsence;
    private $m_viewAbsenceEdit;

    public function __construct()
    {
        $this->m_viewAbsence = new ViewAbsenceDetails();
        $this->m_viewAbsenceEdit = new  ViewAbsenceEdit();
        $this->m_viewAbsenceAdd = new  ViewAbsenceAdd();

    }

    public function handleRequest($getParameters)
    {
        $action = isset($getParameters["action"]) ? $getParameters["action"] : '';
        $absenceKey = isset($getParameters["absenceKey"]) ? $getParameters["absenceKey"] : '';


        switch($action) {
            case 'delete':
                $this->deleteAbsence($absenceKey);
                break;
        }

        $studentId = $getParameters['studentId'];
        $students = ControllerAbsenceDataBase::lookForSpecificUser($studentId);
        $this->m_viewAbsence->setAttendanceData($students);
        $this->m_viewAbsence->render();
    }

    public function deleteAbsence($studentId){
        ControllerDataBase::connectToDatabase();
        ControllerAbsenceDataBase::deleteAbsence($studentId);
        // $this->handleRequest($getParameters);
    }

    public function absenceEdit($getParameters,$postParameters){

        $absenceKey = $_GET['absenceKey'];

        if(isset($_GET["action"])) {
            $action = $_GET["action"];

            $studentKey = isset($postParameters["studentKey"]) ? $postParameters["studentKey"] : '';
            $date = isset($postParameters["date"]) ? $postParameters["date"] : '';
            $comment = isset($postParameters["comment"]) ? $postParameters["comment"] : '';
            $reason = isset($postParameters["reason"]) ? $postParameters["reason"] : '';
            $absenceKey = isset($postParameters["absenceKey"]) ? $postParameters["absenceKey"] : '';


            switch($action) {
                case 'update':
                    ControllerAbsenceDataBase::updateAbsence($absenceKey, $comment, $reason, $date);
                break;
            }
        }

        $record = ControllerAbsenceDataBase::getAbsenceDetailsByKey($absenceKey);


        $this->m_viewAbsenceEdit->setAbsenceData($record);
        $this->m_viewAbsenceEdit->render();
    }

    public function add_absence($getParameters, $postParameters){

        $action = isset($getParameters["action"]) ? $getParameters["action"] : '';
        $studentKey = isset($postParameters["studentKey"]) ? $postParameters["studentKey"] : '';
        $date = isset($postParameters["date"]) ? $postParameters["date"] : '';
        $comment = isset($postParameters["comment"]) ? $postParameters["comment"] : '';
        $reason = isset($postParameters["reason"]) ? $postParameters["reason"] : '';

        switch($action) {
            case 'add':
                $res = ControllerAbsenceDataBase::insertAbsence($studentKey, $comment, $reason, $date);
            break;

        }
        $this->m_viewAbsenceAdd->render();
    }



}
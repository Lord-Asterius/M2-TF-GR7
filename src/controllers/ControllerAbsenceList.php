<?php

include_once(dirname(__FILE__) . "/../views/ViewAbsenceList.php");
include_once(dirname(__FILE__) . "/../database/ControllerDataBase.php");
include_once(dirname(__FILE__) . "/../database/ControllerUserDataBase.php");



class ControllerAbsenceList
{
    private $m_viewAbsenceList;

    public function __construct()
    {
        $this->m_viewAbsenceList = new ViewAbsenceList();
    }

    public function handleRequest($getParameters)
    {
        ControllerDataBase::connectToDatabase();

        $allStudentsName = [];
        $allStudent = ControllerUserDataBase::lookForAllUser();


        foreach ($allStudent as $student)
        {
            $allStudentsName[] = ["name" => $student->getFirstName(), "id" => $student->getKey() ];
        }


        $this->m_viewAbsenceList->setAttendanceData($allStudentsName);
        $this->m_viewAbsenceList->render();
    }
}
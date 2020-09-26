<?php

include_once(dirname(__FILE__) . "/../views/ViewAbsenceList.php");


class ControllerAbsenceList
{
    private $m_viewAbsence;

    public function __construct()
    {
        $this->m_viewAbsence = new ViewAbsenceList();
    }

    public function handleRequest($getParameters)
    {

        // https://www.w3schools.com/php/php_json.asp
        $data = [
                    ["name"=>"fabrice", "module"=>"English", "date"=>"1st June", "studentId"=>1],
                    ["name"=>"fabien", "module"=>"English", "date"=>"1st June", "studentId" => 2],
                    ["name"=>"Aurav", "module"=>"English", "date"=>"1st June", "studentId" => 3],
                    ["name"=>"Test 1", "module"=>"English", "date"=>"1st June", "studentId" => 4],
                    ["name"=>"Test 2", "module"=>"English", "date"=>"1st June", "studentId" => 5]
                ];

        //TODO Get the list of module the current user have access to
        $this->m_viewAbsence->setAttendanceData($data);
        $this->m_viewAbsence->render();
    }
}
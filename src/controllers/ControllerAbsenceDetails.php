<?php

include_once(dirname(__FILE__) . "/../views/ViewAbsenseDetails.php");


class ControllerAbsenceDetails
{
    private $m_viewAbsence;

    public function __construct()
    {
        $this->m_viewAbsence = new ViewAbsenceDetails();
    }

    public function handleRequest($getParameters)
    {

        // https://www.w3schools.com/php/php_json.asp
        $data = [
                    ["name"=>"fabrice", "module"=>"English", "date"=>"1st June", "studentId"=>1],
                    ["name"=>"fabien", "module"=>"English", "date"=>"1st June", "studentId" => 2],
                    ["name"=>"Aurav", "module"=>"English", "date"=>"1st June", "studentId" => 3],
                ];

        //TODO Get the list of module the current user have access to
        $this->m_viewAbsence->setAttendanceData($data);
        $this->m_viewAbsence->render();
    }
}
<?php

include_once(dirname(__FILE__) . "/../views/ViewAbsenceList.php");
include_once(dirname(__FILE__) . "/../database/ControllerDataBase.php");


class ControllerAbsenceList extends ControllerDataBase
{
    private $m_viewAbsence;

    public function __construct()
    {
        $this->m_viewAbsence = new ViewAbsenceList();
    }

    public function handleRequest($getParameters)
    {
        $this->connectToDatabase();
        $sql="select a.key as id,a.reason as reason,a.comment as comment,
        a.date_time as date,e.first_name as first_name, e.last_name as last_name,
        m.name as module_name,a.etudiant_key as etudiant_key from absence a,user e
        ,module m where a.etudiant_key=e.key";
        $sth=$this->query($sql);
        // $result = $sth->fetch(PDO::FETCH_ASSOC);
        // https://www.w3schools.com/php/php_json.asp
        $data=[];
        while($res = $sth->fetch(PDO::FETCH_ASSOC)){
           $dt=date("d M y", strtotime($res['date'])); 
            array_push($data,array("name"=>$res['first_name']." ".$res['last_name'], 
            "module"=>$res['module_name'], "date"=>$dt, "studentId"=>$res['etudiant_key']));
        }
        

        //TODO Get the list of module the current user have access to
        $this->m_viewAbsence->setAttendanceData($data);
        $this->m_viewAbsence->render();
    }
}
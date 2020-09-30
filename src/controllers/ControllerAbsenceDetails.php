<?php

include_once(dirname(__FILE__) . "/../views/ViewAbsenseDetails.php");
include_once(dirname(__FILE__) . "/../database/ControllerDataBase.php");


class ControllerAbsenceDetails extends ControllerDataBase
{
    private $m_viewAbsence;

    public function __construct()
    {
        $this->m_viewAbsence = new ViewAbsenceDetails();
    }

    public function handleRequest($getParameters)
    {
        $this->connectToDatabase();
        if(isset($getParameters["deleteId"]) && $getParameters["deleteId"]!=""){
           echo $sql="delete from absence where `key`=".$getParameters["deleteId"];
            $sth1=$this->query($sql);
            header('Location: index.php?page=absenceDetails&studentId='.$getParameters['studentId']);
        }
       $etudiant_key=$getParameters['studentId'];
       $sql="select a.key as id,a.reason as reason,a.comment as comment,a.created as created,e.first_name as first_name, e.last_name as last_name,m.name as module_name,a.etudiant_key as etudiant_key  from absence a,etudiant e,module m where a.etudiant_key=e.key and a.module_key=m.key and a.etudiant_key=$etudiant_key";
       $sth=$this->query($sql);
       $data=[];
       while($res = $sth->fetch(PDO::FETCH_ASSOC)){
          $dt=date("d M y", strtotime($res['created'])); 
           array_push($data,array("name"=>$res['first_name']." ".$res['last_name'], "module"=>$res['module_name'], "date"=>$dt, "entryid"=>$res["id"],"studentId"=>$res['etudiant_key']));
       }
       $this->m_viewAbsence->setAttendanceData($data);
       $this->m_viewAbsence->render();
   }


    public function EditRequest($getParameters)
    {
        $this->connectToDatabase();
        if(isset($getParameters["editId"]) && $getParameters["editId"]!=""){
           echo $sql="select * from absence where `key`=".$getParameters["editId"];
            $sth1=$this->query($sql);
            header('Location: index.php?page=absenceDetails&studentId='.$getParameters['studentId']);
        }
       $etudiant_key=$getParameters['studentId'];
      // $sql="select a.key as id,a.reason as reason,a.comment as comment,a.created as created,e.first_name as first_name, e.last_name as last_name,m.name as module_name,a.etudiant_key as etudiant_key  from absence a,etudiant e,module m where a.etudiant_key=e.key and a.module_key=m.key and a.etudiant_key=$etudiant_key";
      $sql="select * from absence where `key`=".$getParameters["editId"];
      $sth=$this->query($sql);
       $data=[];
       while($res = $sth->fetch(PDO::FETCH_ASSOC)){
        //  $dt=date("d M y", strtotime($res['created'])); 
           array_push($data,array("reason"=>$res['reason']."comment".$res['comment'], "time"=>$res['created']));
       }


        // https://www.w3schools.com/php/php_json.asp
        // $data = ["
        //             ["name"=>"fabrice", "module"=>"English", "date"=>"1st June", "studentId"=>1],
        //             ["name"=>"fabien", "module"=>"English", "date"=>"1st June", "studentId" => 2],
        //             ["name"=>"Aurav", "module"=>"English", "date"=>"1st June", "studentId" => 3],
        //         ];

        //TODO Get the list of module the current user have access to
        $this->m_viewAbsence->setAttendanceData($data);
        $this->m_viewAbsence->render();
    }
}
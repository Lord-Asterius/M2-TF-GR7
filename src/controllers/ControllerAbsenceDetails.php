<?php

$path=$_SERVER['DOCUMENT_ROOT']."/M2-TF-GR7/src";
include_once($path . "/views/ViewAbsenseDetails.php");
include_once($path . "/models/ModelAbsenceDetails.php");


class ControllerAbsenceDetails
{
    private $m_viewAbsence;
    private $model;

    public function __construct()
    {
        $this->m_viewAbsence = new ViewAbsenceDetails();
        $this->model = new ModelAbsenceDetails();
    }

    public function handleRequest($getParameters)
    {

        // https://www.w3schools.com/php/php_json.asp
      /*  $data = [
                    ["first_name"=>"fabrice", "name"=>"English", "comment"=>"1st June", "reason"=>"Personal problem"],
                    ["first_name"=>"fabrice", "name"=>"English", "comment"=>"1st June", "reason"=>"Personal problem"],
                    ["first_name"=>"fabrice", "name"=>"English", "comment"=>"1st June", "reason"=>"Personal problem"],
                ];*/

        //TODO Get the list of module the current user have access to
        //$this->m_viewAbsence->setAttendanceData();
        $student['student_id']= $_GET['studentId'];
        $students = $this->model->get_student($_GET['studentId']);   
        //print_r($students);  
        $this->m_viewAbsence->setAttendanceData($students);
        $this->m_viewAbsence->render();
    }

    public function reload(){    
            $student_id= $_GET['student_id'];
            //echo $student_id;
            $result = $this->model->reload($student_id);            

            echo json_encode($result);            
     }


    public function add_student(){       
            $student_id= $_POST['student_id'];
           $this->model->add_student($student_id);
           echo "Absence added succesfully";
    }

    public function modify_student(){      
            $this->model->modify_student();
            echo "Absence modified succesfully";
     }
     public function delete_student(){        
            $this->model->delete_student();
            echo "Absence deleted succesfully";
     }

}
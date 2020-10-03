<?php

include_once(dirname(__FILE__) . "/../controllers/ControllerDB.php");



class ModelAbsenceDetails
{
    private $db;

    public function __construct()
    {
        $this->db = new ControllerDB();
    }

    public function get_students()
    {          
        $this->db->connect();
    
        $sql = "SELECT * FROM user";         
        $result = $this->db->query($sql);
               
        $this->db->close();

       // print_r($result);die();
        return $result;
    }
    public function get_student($student_id)
    {          
        $this->db->connect();
    
         $sql = "SELECT * FROM user u where u.key=$student_id";         
        $result = $this->db->query($sql);
               
        $this->db->close();

       // print_r($result);die();
        return $result;
    }

    public function reload($student_id)
    {          
        $this->db->connect();
    
        $sql = "SELECT absence.key AS 'id_absence',etudiant_key AS 'id_etudiant',first_name,comment,reason,date
        FROM absence 
        INNER JOIN user ON etudiant_key = user.key where etudiant_key=$student_id";         
        $result = $this->db->query($sql);
       
        
        $this->db->close();

       // print_r($result);die();
        return $result;
    }

    public function add_student($student_id)
    {     

        $nom_etudiant = $_POST["nom_etudiant"];
        $date = $_POST["date"];
        $module = $_POST["module"];
        $motif_absence = $_POST["motif_absence"];
        
        $this->db->connect();
    
        //$sql = "INSERT INTO user(first_name,role)  VALUES('$nom_etudiant','ETUDIANT')";            
        //$result = $this->db->query($sql);

        //if($result == FALSE)
        //die($sql);

        //$id_student = $this->db->get_last_id();
             
        $sql = "INSERT INTO absence(etudiant_key,comment,reason, date) VALUES('$student_id','$module','$motif_absence','$date')";
        $result = $this->db->query($sql);

       if($result == FALSE)
       die($sql);
        
        $this->db->close();
    }

    public function modify_student(){
        $id_absence = $_POST["id_absence"];
        $id_etudiant = $_POST["id_student"];
        
        $nom_etudiant = $_POST["nom_etudiant"];
        $date = $_POST["date"];
        $module = $_POST["module"];
        $motif_absence = $_POST["motif_absence"];

        $this->db->connect();

       $result= $sql = "UPDATE absence SET comment = '$module',reason = '$motif_absence',date = '$date' WHERE `key` = $id_absence";        
        $this->db->query($sql);

       
       // $sql = "UPDATE user SET first_name = '$nom_etudiant' WHERE `key` = $id_etudiant";        
        // $result=  $this->db->query($sql);

 //if($result == FALSE)
      // die($sql);
       
        $this->db->close();
    }

    public function delete_student(){
        $this->db->connect();

        $id_absence = $_POST["id_absence"];
        $id_student = $_POST["id_student"];        

        $sql = "DELETE FROM absence WHERE `key` = $id_absence";        
        $this->db->query($sql);

       // $sql = "DELETE FROM user WHERE `key` = $id_student";
       // $this->db->query($sql);        

        $this->db->close();
    }
}
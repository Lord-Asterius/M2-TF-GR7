<?php


// Modal object
// controller object


class ControllerAbsenceDataBase
{
    private $absence;

    /**
     * ControllerUserDataBase constructor.
     * @param $user
     */
    public function __construct($absence)
    {
        $this->absence = $absence;

        ControllerDataBase::connectToDatabase();
    }

    // `key``reason``reason``etudiant_key``module_key``comment``created`
    private function bindInsertAbsence()
    {

        $key = $this->absence->getKey();
        $reason = $this->absence->getReason();
        $comment = $this->absence->getComment();
        $date = $this->absence->getDate();

        $insertAbsence = ControllerDatabase::getInsertAbsence();
        $insertAbsence->bindParam(':reason', $reason);
        $insertAbsence->bindParam(':etudiant_key', $key);
        $insertAbsence->bindParam(':comment', $comment);

    }


    // const controller = ControllerAbsence(absense);
    // controller.commit();


    public function commit()
    {
        ControllerDataBase::prepareInsertAbsence();
        $this->bindInsertAbsence();
        ControllerDataBase::getInsertAbsence()->execute();
    }

    public static function getForAllAbsence()
    {
        ControllerDataBase::prepareSelectAllAbsence();
        if (ControllerDataBase::getSelectAllAbsence()->execute()) {
           
            $row = ControllerDataBase::getSelectAllAbsence()->fetch();
            if ($row) {

              
                $response = [];
                
                do {
                    $data['firstName'] = $row['first_name'];
                    $data['lastName'] = $row['last_name'];    
                    $data['moduleName'] = $row['module'];
                    $data['date'] = $row['date_time'];
                    $data["absenceKey"] = $row['absenceKey'];

                    $response[] = $data;
                    
                } while ($row = ControllerDataBase::getSelectAllAbsence()->fetch());
                
                return $response;
            }
        }
      
        return [];
    }


    public static function lookForSpecificUser($id)
    {
        
        ControllerDataBase::prepareSelectSpecificStudentAbsence($id);
        if (ControllerDataBase::getSelectSpecificStudentAbsence()->execute()) {
           
            $row = ControllerDataBase::getSelectSpecificStudentAbsence()->fetch();
            if ($row) {

              
                $response = [];
                
                do {
                    $data['firstName'] = $row['first_name'];
                    $data['lastName'] = $row['last_name'];
                    $data['mail'] = $row['mail'];
                    $data['moduleName'] = $row['name'];
                    $data['reason'] = $row['reason'];
                    $data['comment'] = $row['comment'];
                    $data['date'] = $row['date'];

                    $response[] = $data;
                    
                } while ($row = ControllerDataBase::getSelectSpecificStudentAbsence()->fetch());
                
                return $response;
            }
        }
      
        return [];
    }

    
    public function getAbsence()
    {
        return $this->absence;
    }

    public static function deleteAbsence($studentAbscent)
    {
    ControllerDataBase::prepareDeleteAbsence();
        return ControllerDataBase::getDeleteAbsence()->execute(array($studentAbscent));
    }

    public static function insertAbsence($studentKey, $comment, $reason, $date) {

        $dateTime = date('Y-m-d h:i:s', strtotime($date));


        ControllerDataBase::prepareInsertAbsence();
        $insertAbsence = ControllerDataBase::getInsertAbsence();
        $insertAbsence->bindParam(':reason', $reason);
        $insertAbsence->bindParam(':etudiant_key', $studentKey);
        $insertAbsence->bindParam(':comment', $comment);
        $insertAbsence->bindParam(':date_time', $dateTime);

        $res = ControllerDataBase::getInsertAbsence()->execute();
    
    }

   

}
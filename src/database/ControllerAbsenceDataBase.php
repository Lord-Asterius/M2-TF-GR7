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


    public static function lookForSpecificUser($id)
    {
        //return ['ammad'];
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

   

}
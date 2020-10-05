<?php

class ControllerDataBase
{


    private static $dataBaseConnector;
    private static $insertUser;
    private static $insertModule;
    private static $insertAbsence;
    private static $selectAllUser;
    private static $selectAllTeacher;
    private static $selectAllAdminStaff;
    private static $selectAllAllAdmin;
    private static $selectAllAllStudent;
    private static $selectSpecificUser;
    private static $selectAllAbsence;
    private static $selectAllModule;
    private static $selectSpecificUserModule;
    private static $insertUserModule;
    private static $insertReferentModule;
    private static $selectSpecificModule;
    private static $selectSpecificReferentModule;
    private static $selectAllStudentInModule;
    private static $DeleteModule;
    private static $DeleteUser;
    private static $removeUserModule;
    private static $removeUserReferentModule;


    public static function connectToDatabase()
    {
        try {
            if (IS_RELEASE) {
                self::$dataBaseConnector = new PDO('mysql:host=' . SERVER_RELEASE . ';dbname=' . DB . 'qui_est_la', USER_RELEASE, PASS_RELEASE);
            } else {
                self::$dataBaseConnector = new PDO('mysql:host=' . SERVER . ';dbname=' . DB, USER, PASS);
            }

        } catch (PDOException $e) {
            if (IS_RELEASE) {
                self::errorExit('<h4>Error when connecting to the database</h4>');
            } else {
                self::errorExit('<h4>Error when connecting to the database : ' . $e->getMessage() . '</h4>');
            }
            die();
        }
    }

    public static function disconnectFromDataBase()
    {
        self::$dataBaseConnector = null;
    }

    private static function setPrepareToNull()
    {
        self::$insertUser = null;
        self::$insertModule = null;
        self::$insertAbsence = null;
        self::$selectAllUser = null;
        self::$selectAllTeacher = null;
        self::$selectAllAdminStaff = null;
        self::$selectAllAllAdmin = null;
        self::$selectAllAllStudent = null;
        self::$selectSpecificUser = null;
        self::$selectAllAbsence = null;
        self::$selectAllModule = null;
        self::$selectSpecificUserModule = null;
        self::$insertUserModule = null;
        self::$insertReferentModule = null;
        self::$selectSpecificModule = null;
        self::$selectSpecificReferentModule = null;
        self::$selectAllStudentInModule = null;
        self::$DeleteModule = null;
        self::$DeleteUser = null;
        self::$removeUserModule = null;
        self::$removeUserReferentModule = null;
    }


    public static function prepareInsertUser()
    {
        if (self::$insertUser == null) {
            self::setPrepareToNull();
            self::$insertUser = self::$dataBaseConnector->prepare("INSERT INTO user(id, password, first_name, last_name, mail, role, date_naissance) VALUES (:id, :password, :first_name, :last_name, :mail, :role, :date_naissance)");
            return self::$insertUser;
        }
        return true;
    }

    public static function prepareInsertModule()
    {
        if (self::$insertModule == null) {
            self::setPrepareToNull();
            return self::$insertModule = self::$dataBaseConnector->prepare("INSERT INTO module(name) VALUES (:name)");
        }
        return true;
    }

    public static function prepareInsertAbsence()
    {
        if (self::$insertAbsence == null) {
            self::setPrepareToNull();
            return self::$insertAbsence = self::$dataBaseConnector->prepare("INSERT INTO absence(reason, etudiant_key, comment, date_time) VALUES (?, ?, ?, ?)");
        }
        return true;
    }

    //TODO: séparé les appels à user et à leurs modules pour discriminer les
    public static function prepareSelectAllUser()
    {
        if (self::$selectAllUser == null) {
            self::setPrepareToNull();
            return self::$selectAllUser = self::$dataBaseConnector->prepare("SELECT * FROM user LEFT JOIN user_module ON user.key = user_module.user_key LEFT JOIN module ON user_module.module_key = module.key LEFT JOIN absence ON user.key = absence.etudiant_key");
        }
        return true;
    }

    public static function prepareSelectAllTeacher()
    {
        if (self::$selectAllTeacher == null) {
            self::setPrepareToNull();
            return self::$selectAllTeacher = self::$dataBaseConnector->prepare("SELECT * FROM user LEFT JOIN user_module ON user.key = user_module.user_key LEFT JOIN module ON user_module.module_key = module.key WHERE user.role = 'ENSEIGNANT' ");
        }
        return true;

    }

    public static function prepareSelectAllAdminStaff()
    {
        if (self::$selectAllAdminStaff == null) {
            self::setPrepareToNull();
            return self::$selectAllAdminStaff = self::$dataBaseConnector->prepare("SELECT * FROM user LEFT JOIN user_module ON user.key = user_module.user_key LEFT JOIN module ON user_module.module_key = module.key WHERE user.role = 'EQUIPE_ADMINISTRATIVE' ");
        }
        return true;

    }

    public static function prepareSelectAllAdmin()
    {
        if (self::$selectAllAllAdmin == null) {
            self::setPrepareToNull();
            return self::$selectAllAllAdmin = self::$dataBaseConnector->prepare("SELECT * FROM user LEFT JOIN user_module ON user.key = user_module.user_key LEFT JOIN module ON user_module.module_key = module.key LEFT JOIN absence ON user.key = absence.etudiant_key WHERE user.role = 'ADMINISTRATEUR' ");
        }
        return true;

    }

    public static function prepareSelectAllStudent()
    {
        if (self::$selectAllAllStudent == null) {
            self::setPrepareToNull();
            return self::$selectAllAllStudent = self::$dataBaseConnector->prepare("SELECT * FROM user LEFT JOIN user_module ON user.key = user_module.user_key LEFT JOIN module ON user_module.module_key = module.key LEFT JOIN absence ON user.key = absence.etudiant_key WHERE user.role = 'ETUDIANT' ");
        }
        return true;

    }

    public static function prepareSelectAllStudentInModule()
    {
        if (self::$selectAllStudentInModule == null) {
            self::setPrepareToNull();
            return self::$selectAllStudentInModule = self::$dataBaseConnector->prepare("SELECT * FROM user LEFT JOIN user_module ON user.key = user_module.user_key LEFT JOIN module ON user_module.module_key = module.key WHERE user.role = 'ETUDIANT' AND module.name = ?");
        }
        return true;
    }

    public static function prepareSelectSpecificUser()
    {
        if (self::$selectSpecificUser == null) {
            self::setPrepareToNull();
            return self::$selectSpecificUser = self::$dataBaseConnector->prepare("SELECT * FROM user LEFT JOIN user_module ON user.key = user_module.user_key LEFT JOIN module ON user_module.module_key = module.key LEFT JOIN enseigant_referent on user.`key` = enseigant_referent.enseigant_key LEFT JOIN module as module_ref ON enseigant_referent.module_key = module_ref.key LEFT JOIN absence ON user.key = absence.etudiant_key WHERE user.id = ?");
        }
        return true;
    }

    public static function prepareSelectSpecificUserModule()
    {
        if (self::$selectSpecificUserModule == null) {
            self::setPrepareToNull();
            return self::$selectSpecificUserModule = self::$dataBaseConnector->prepare("SELECT * FROM module LEFT JOIN user_module ON module.`key` = user_module.module_key LEFT JOIN user ON user_module.user_key = user.`key` WHERE user.id = ?");
        }
        return true;
    }

    public static function prepareSelectSpecificReferentModule()
    {
        if (self::$selectSpecificReferentModule == null) {
            self::setPrepareToNull();
            return self::$selectSpecificReferentModule = self::$dataBaseConnector->prepare("SELECT * FROM module LEFT JOIN enseigant_referent ON module.`key` = enseigant_referent.module_key LEFT JOIN user ON enseigant_referent.enseigant_key = user.`key` WHERE user.id = ?");
        }
        return true;
    }


    public static function prepareInsertUserModule()
    {
        if (self::$insertUserModule == null) {
            self::setPrepareToNull();
            return self::$insertUserModule = self::$dataBaseConnector->prepare("INSERT INTO user_module(user_key, module_key) VALUE (?, ?)");
        }
        return true;
    }

    public static function prepareRemoveUserModule()
    {
        if (self::$removeUserModule == null) {
            self::setPrepareToNull();
            return self::$removeUserModule = self::$dataBaseConnector->prepare("DELETE FROM user_module WHERE user_key = ? AND module_key = ?");
        }
        return true;
    }


    public static function prepareRemoveUserReferentModule()
    {
        if (self::$removeUserReferentModule == null) {
            self::setPrepareToNull();
            return self::$removeUserReferentModule = self::$dataBaseConnector->prepare("DELETE FROM enseigant_referent WHERE enseigant_key = ? AND module_key = ?");
        }
        return true;
    }

    public static function prepareInsertReferentModule()
    {
        if (self::$insertReferentModule == null) {
            self::setPrepareToNull();
            return self::$insertReferentModule = self::$dataBaseConnector->prepare("INSERT INTO enseigant_referent(enseigant_key, module_key) VALUE (?, ?)");
        }
        return true;
    }

    public static function prepareSelectAllAbsence()
    {
        if (self::$selectAllAbsence == null) {
            self::setPrepareToNull();
            return self::$selectAllAbsence = self::$dataBaseConnector->prepare("SELECT * FROM absence");
        }
        return true;
    }

    public static function prepareSelectSpecificModule()
    {
        if (self::$selectSpecificModule == null) {
            self::setPrepareToNull();
            return self::$selectSpecificModule = self::$dataBaseConnector->prepare("SELECT * FROM module WHERE name = ?");
        }
        return true;
    }

    public static function prepareSelectAllModule()
    {
        if (self::$selectAllModule == null) {
            self::setPrepareToNull();
            return self::$selectAllModule = self::$dataBaseConnector->prepare("SELECT * FROM module");
        }
        return true;
    }

    public static function prepareDeleteModule()
    {
        if (self::$DeleteModule == null) {
            self::setPrepareToNull();
            return self::$DeleteModule = self::$dataBaseConnector->prepare("DELETE FROM module WHERE `name` = ?");
        }
        return true;
    }

    public static function prepareDeleteUser()
    {
        if (self::$DeleteUser == null) {
            self::setPrepareToNull();
            return self::$DeleteUser = self::$dataBaseConnector->prepare("DELETE FROM user WHERE `id` = ?");
        }
        return true;
    }

    public static function getDataBaseConnector()
    {
        return self::$dataBaseConnector;
    }

    public static function getInsertModule()
    {
        return self::$insertModule;
    }

    public static function getInsertAbsence()
    {
        return self::$insertAbsence;
    }

    public static function getSelectAllUser()
    {
        return self::$selectAllUser;
    }

    public static function getSelectAllTeacher()
    {
        return self::$selectAllTeacher;
    }

    public static function getSelectAllAdminStaff()
    {
        return self::$selectAllAdminStaff;
    }

    public static function getSelectAllAllAdmin()
    {
        return self::$selectAllAllAdmin;
    }

    public static function getSelectAllAllStudent()
    {
        return self::$selectAllAllStudent;
    }

    public static function getDeleteUser()
    {
        return self::$DeleteUser;
    }

    public static function getSelectSpecificUser()
    {
        return self::$selectSpecificUser;
    }


    public static function getRemoveUserModule()
    {
        return self::$removeUserModule;
    }

    public static function getSelectAllAbsence()
    {
        return self::$selectAllAbsence;
    }


    public static function getInsertUser()
    {
        return self::$insertUser;
    }


    public static function getSelectSpecificUserModule()
    {
        return self::$selectSpecificUserModule;
    }

    public static function getSelectAllModule()
    {
        return self::$selectAllModule;
    }


    public static function getInsertUserModule()
    {
        return self::$insertUserModule;
    }

    /**
     * @return mixed
     */
    public static function getSelectSpecificModule()
    {
        return self::$selectSpecificModule;
    }

    public static function getInsertReferentModule()
    {
        return self::$insertReferentModule;
    }

    /**
     * @return mixed
     */
    public static function getSelectSpecificReferentModule()
    {
        return self::$selectSpecificReferentModule;
    }





    /**
     * @return mixed
     */
    public static function getSelectAllStudentInModule()
    {
        return self::$selectAllStudentInModule;
    }


    /**
     * @return mixed
     */
    public static function getDeleteModule()
    {
        return self::$DeleteModule;
    }

//____________________________________________________________________________


    /**
     * Arrêt du script si erreur base de données
     *
     * Affichage d'un message d'erreur, puis arrêt du script
     * Fonction appelée quand une erreur 'base de données' se produit :
     *        - lors de la phase de connexion au serveur MySQL
     *        - ou indirectement lorsque l'envoi d'une requête échoue
     *
     * @param string $msg Message d'erreur à afficher
     */
    private static function errorExit(string $msg)
    {
        echo '<!DOCTYPE html><html lang="fr"><head><meta charset="UTF-8"><title>',
        'Erreur base de données</title>',
        '<style>table{border-collapse: collapse;}td{border: 1px solid black;padding: 4px 10px;}</style>',
        '</head><body>',
        $msg,
        '</body></html>';
    }

//____________________________________________________________________________

    /**
     * TODO: tmp function too be removed
     *
     * Use for select request
     *
     * foreach  (returnedValue as $row) {
     *   print $row['name'] . "\t";
     * }
     * @param string $sql
     * @return mixed
     */
    public static function query(string $sql)
    {
        return self::$dataBaseConnector->query($sql);
    }

    /**
     * TODO: tmp function too be removed
     *
     * Use for insert delete ...
     *
     * @param string $sql
     * @return mixed nb of line affected
     */
    public static function exec(string $sql)
    {
        return self::$dataBaseConnector->exec($sql);
    }


    /**
     *    Protection des sorties (code HTML généré à destination du client).
     *
     *  Fonction à appeler pour toutes les chaines provenant de :
     *        - de saisies de l'utilisateur (formulaires)
     *        - de la bdD
     *    Permet de se protéger contre les attaques XSS (Cross site scripting)
     *    Convertit tous les caractères éligibles en entités HTML, notamment :
     *        - les caractères ayant une signification spéciales en HTML (<, >, ...)
     *        - les caractères accentués
     *
     * @param string $str la chaine à protéger
     * @return string    la chaîne protégée
     */
    function protectXss(string $str)
    {
        $str = trim($str);
        return htmlentities($str, ENT_QUOTES, 'UTF-8');
    }


}

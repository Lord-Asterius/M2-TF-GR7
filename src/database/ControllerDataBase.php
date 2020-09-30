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
    private static $selectAllSpecificUser;
    private static $selectAllAbsence;

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
        self::$selectAllSpecificUser = null;
        self::$selectAllAbsence = null;
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
        if (self::$insertModule == null) {
            self::setPrepareToNull();
            return self::$insertAbsence = self::$dataBaseConnector->prepare("INSERT INTO absence(reason, etudiant_key, comment) VALUES (:reason, :etudiant_key, :comment)");
        }
        return true;
    }

    //TODO: séparé les appels à user et à leurs modules pour discriminer les
    public static function prepareSelectAllUser()
    {
        if (self::$insertModule == null) {
            self::setPrepareToNull();
            return self::$selectAllUser = self::$dataBaseConnector->prepare("SELECT * FROM user LEFT JOIN user_module ON user.key = user_module.user_key LEFT JOIN module ON user_module.module_key = module.key LEFT JOIN absence ON user.key = absence.etudiant_key");
        }
        return true;
    }

    public static function prepareSelectAllTeacher()
    {
        if (self::$insertModule == null) {
            self::setPrepareToNull();
            return self::$selectAllTeacher = self::$dataBaseConnector->prepare("SELECT * FROM user LEFT JOIN user_module ON user.key = user_module.user_key LEFT JOIN module ON user_module.module_key = module.key WHERE user.role = 'ENSEIGNANT' ");
        }
        return true;

    }

    public static function prepareSelectAllAdminStaff()
    {
        if (self::$insertModule == null) {
            self::setPrepareToNull();
            return self::$selectAllAdminStaff = self::$dataBaseConnector->prepare("SELECT * FROM user LEFT JOIN user_module ON user.key = user_module.user_key LEFT JOIN module ON user_module.module_key = module.key WHERE user.role = 'EQUIPE_ADMINISTRATIVE' ");
        }
        return true;

    }

    public static function prepareSelectAllAdmin()
    {
        if (self::$insertModule == null) {
            self::setPrepareToNull();
            return self::$selectAllAllAdmin = self::$dataBaseConnector->prepare("SELECT * FROM user LEFT JOIN user_module ON user.key = user_module.user_key LEFT JOIN module ON user_module.module_key = module.key LEFT JOIN absence ON user.key = absence.etudiant_key WHERE user.role = 'ADMINISTRATEUR' ");
        }
        return true;

    }

    public static function prepareSelectAllStudent()
    {
        if (self::$insertModule == null) {
            self::setPrepareToNull();
            return self::$selectAllAllStudent = self::$dataBaseConnector->prepare("SELECT * FROM user LEFT JOIN user_module ON user.key = user_module.user_key LEFT JOIN module ON user_module.module_key = module.key LEFT JOIN absence ON user.key = absence.etudiant_key WHERE user.role = 'ETUDIANT' ");
        }
        return true;

    }

    public static function prepareSelectSpecificUser()
    {
        if (self::$insertModule == null) {
            self::setPrepareToNull();
            return self::$selectAllSpecificUser = self::$dataBaseConnector->prepare("SELECT * FROM user LEFT JOIN user_module ON user.key = user_module.user_key LEFT JOIN module ON user_module.module_key = module.key LEFT JOIN absence ON user.key = absence.etudiant_key WHERE user.id = ?");
        }
        return true;

    }

    public static function prepareSelectAllAbsence()
    {
        if (self::$insertModule == null) {
            self::setPrepareToNull();
            return self::$selectAllAbsence = self::$dataBaseConnector->prepare("SELECT * FROM absence");
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

    public static function getSelectSpecificUser()
    {
        return self::$selectAllSpecificUser;
    }

    public static function getSelectAllAbsence()
    {
        return self::$selectAllAbsence;
    }

    public static function getInsertUser()
    {
        return self::$insertUser;
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

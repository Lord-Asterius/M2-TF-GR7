<?php

class ControllerDataBase
{


    private static $data_base_connector;


    public static function connectToDatabase()
    {
        try {
            if (IS_RELEASE) {
                self::$data_base_connector = new PDO('mysql:host=' . SERVER_RELEASE . ';dbname=' . DB . 'qui_est_la', USER_RELEASE, PASS_RELEASE);
            } else {
                self::$data_base_connector = new PDO('mysql:host=' . SERVER . ';dbname=1' . DB, USER, PASS);
            }

        } catch (PDOException $e) {
            self::errorExit('<h4>Error when connecting to the database</h4>');
            die();
        }
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

//SELECT * FROM enseignant, enseignant_module, module WHERE enseignant.key = enseignant_module.enseignant_key AND enseignant_module.module_key = module.key


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
    function query(string $sql){
        return self::$data_base_connector->query($sql);
    }

    /**
     * TODO: tmp function too be removed
     *
     * Use for insert delete ...
     *
     * @param string $sql
     * @return mixed nb of line affected
     */
    function exec(string $sql) {
        return self::$data_base_connector->exec($sql);
    }

    /**
     * Gestion d'une erreur de requête à la base de données.
     *
     * A appeler impérativement quand un appel de mysqli_query() échoue
     * Appelle la fonction fd_bd_erreurExit() qui affiche un message d'erreur puis termine le script
     *
     * @param mysqli $bd Connecteur sur la bd ouverte
     * @param string $sql requête SQL provoquant l'erreur
     */
    function requestError(mysqli $bd, string $sql)
    {
        $errNum = mysqli_errno($bd);
        $errTxt = mysqli_error($bd);

        // Collecte des informations facilitant le debugage
        $msg = '<h4>Erreur de requête</h4>'
            . "<pre><b>Erreur mysql :</b> $errNum"
            . "<br> $errTxt"
            . "<br><br><b>Requête :</b><br> $sql"
            . '<br><br><b>Pile des appels de fonction</b></pre>';

        // Récupération de la pile des appels de fonction
        $msg .= '<table>'
            . '<tr><td>Fonction</td><td>Appelée ligne</td>'
            . '<td>Fichier</td></tr>';

        $appels = debug_backtrace();
        for ($i = 0, $iMax = count($appels); $i < $iMax; $i++) {
            $msg .= '<tr style="text-align: center;"><td>'
                . $appels[$i]['function'] . '</td><td>'
                . $appels[$i]['line'] . '</td><td>'
                . $appels[$i]['file'] . '</td></tr>';
        }

        $msg .= '</table>';

        self::errorExit($msg);    // => ARRET DU SCRIPT
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
    function protectSortie(string $str)
    {
        $str = trim($str);
        return htmlentities($str, ENT_QUOTES, 'UTF-8');
    }


}

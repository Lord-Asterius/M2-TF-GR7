<?php

include_once(dirname(__FILE__) . "/../views/ViewAdminModuleList.php");
include_once(dirname(__FILE__) . "/../views/ViewAdminModuleEdit.php");
include_once(dirname(__FILE__) . "/../views/ViewAdminModuleInscriptionEnseignants.php");
include_once(dirname(__FILE__) . "/../views/ViewAdminModuleInscriptionEtudiants.php");
include_once(dirname(__FILE__) . "/../views/ViewAdminModuleMenuSubscibe.php");
include_once(dirname(__FILE__) . "/../database/ControllerDataBase.php");
include_once(dirname(__FILE__) . "/../database/ControllerModuleDataBase.php");
include_once(dirname(__FILE__) . '/../database/Module.php');


//todo renommé classe en ControlleAdminModule tout silmple

class ControllerAdminModuleList
{
    private $m_viewAdminModuleList;
    private $m_ViewAdminModuleEdit;
    private $m_viewAdminModuleInscriptionEnseignants;
    private $m_viewAdminModuleMenuSubscibe;


    public function __construct()
    {
        $this->m_viewAdminModuleList = new ViewAdminModuleList();
        $this->m_ViewAdminModuleEdit = new ViewAdminModuleEdit();
        $this->m_viewAdminModuleInscriptionEnseignants = new ViewAdminModuleInscriptionEnseignants();
        $this->m_viewAdminModuleInscriptionEtudiants = new ViewAdminModuleInscriptionEtudiants();
        $this->m_viewAdminModuleMenuSubscibe = new ViewAdminModuleMenuSubscibe();

        ControllerDataBase::connectToDatabase();

    }

    public function handleRequest($getParameters)
    {
        $modules = ControllerModuleDataBase::lookForAllModule();
        $modulesName = array();
        foreach ($modules as $module) {
            array_push($modulesName, $module->getName());
        }
        $this->m_viewAdminModuleList->setModulesNamesList($modulesName);
        $this->m_viewAdminModuleList->render();
    }

    public function deleteModule($getParameters)
    {
        ControllerModuleDataBase::deleteModule($getParameters["module"]);
        $this->handleRequest($getParameters);
    }

    public function editModule($getParameters)
    {
        $this->m_ViewAdminModuleEdit->render($getParameters);
    }

    public function checkFieldValidity()
    {
        $errorToDisplay = "";

        if (!(preg_match("/[a-zA-Z1-9]/", $_POST['moduleName']))) {
            $errorToDisplay = $errorToDisplay . "Le nom du module ne doit pas etre vide\n";
        }

        return $errorToDisplay;
    }

    public function redirectAdd($error)
    {
        if ($error != "") {
            Utils::redirectTo(PAGE_ID_MODULE_EDIT, ["add" => "true", "error" => $error]);
        }
    }

//    public function checkUserValidField()
//    {
//        $errorToDisplay = "";
//
////        if (count(User::isPasswordValid($_POST['password'])) != 0) {
////            $errorToDisplay = $errorToDisplay . "Mot de pass : min 8 caracteres; au moins un nombre, une majuscule, minuscule et un caractere spécial.\n";
////        }
//
//        if (!(preg_match("/[a-zA-Z]/", $_POST['last_name']) && preg_match("/[a-zA-Z]/", $_POST['first_name']))) {
//            $errorToDisplay = $errorToDisplay . "Le nom et prénom de l'utilisateurs doivent contenir uniquement des lettres\n";
//        }
//
//        if (!(preg_match("/[1-9]/", $_POST['student_number']))) {
//            $errorToDisplay = $errorToDisplay . "Le numéro d'étudiant ne doit contenir que des chiffres\n";
//        }
//
//        return $errorToDisplay;
//    }
//
//    public function redirectModif($error, $id) {
//        if ($error != "") {
//            Utils::redirectTo(PAGE_ID_ETUDIANT_EDIT, ["add" => false,"key" => $id, "error" => $error]);
//        }
//    }
//
//    public function redirectAdd($error) {
//        if ($error != "") {
//            Utils::redirectTo(PAGE_ID_ETUDIANT_EDIT, ["add" => true,"error" => $error]);
//        }
//    }
    public function modifyAdminModule(array $sanitizedGet)
    {
    }

    public function addAdminModule($getParameters)
    {
        $errors = $this->checkFieldValidity();
        if ($errors != "") {
            $this->redirectAdd($errors);
        }
        $module = new Module(1, $_POST['moduleName']);
        $controllerModule = new ControllerModuleDataBase($module);
        $controllerModule->commit();
        $this->handleRequest($getParameters);
    }

    public function adminModuleSubscribe($getParameters)
    {

        $this->m_viewAdminModuleMenuSubscibe->setModule($getParameters["module"]);
        $this->m_viewAdminModuleMenuSubscibe->render();
    }

    public function editModuleInscriptionEnseignants($getParameters)
    {
        $enseignants = ControllerUserDataBase::lookForAllTeacher();
        $tab = array();
        // Parcourt tout les enseignant
        foreach ($enseignants as $enseignant) {
            // Ajouter au tab de l'enseignant le module a true si il possede le module recuperé en get
            $modules = $enseignant->getModule();
            $resModule = 0;
            foreach ($modules as $key => $value) {
                if ($getParameters["module"] == $value->getName()) {
                    $resModule = 1;
                }
            }
            $modulesRef = $enseignant->getModuleReferent();
            $resModuleRef = 0;
            foreach ($modulesRef as $k => $v) {
                if ($getParameters["module"] == $v->getName()) {
                    $resModuleRef = 1;
                }
            }
            $tab[$enseignant->getId()] = ["name" => $enseignant->getFirstName() . ' ' . $enseignant->getLastName(), "module" => $resModule, "module_ref" => $resModuleRef];
        }
        $this->m_viewAdminModuleInscriptionEnseignants->setEnseignantList($tab);

        $this->m_viewAdminModuleInscriptionEnseignants->render();
    }

    public function editModuleInscriptionEtudiants($getParameters)
    {
        $etudiants = ControllerUserDataBase::lookForAllStudents();
        $tab = array();
        // Parcourt tout les etudiant
        foreach ($etudiants as $etudiant) {
            // Ajouter au tab de l'etudiant le module a true si il possede le module recuperé en get
            $modules = $etudiant->getModule();
            $resModule = 0;
            foreach ($modules as $key => $value) {
                if ($getParameters["module"] == $value->getName()) {
                    $resModule = 1;
                }
            }
            $modulesRef = $etudiant->getModuleReferent();
            $resModuleRef = 0;
            foreach ($modulesRef as $k => $v) {
                if ($getParameters["module"] == $v->getName()) {
                    $resModuleRef = 1;
                }
            }
            $tab[$etudiant->getId()] = ["name" => $etudiant->getFirstName() . ' ' . $etudiant->getLastName(), "module" => $resModule, "module_ref" => $resModuleRef];
        }
        $this->m_viewAdminModuleInscriptionEtudiants->setEtudiantList($tab);

        $this->m_viewAdminModuleInscriptionEtudiants->render();
    }

    public function setModuleInscriptionsEnseignants($getParameters)
    {
        $enseignantsFromPost = array();
        foreach ($_POST as $k => $v) {
            $enseignantsFromPost[] = $k;
        }

        $enseignants = ControllerUserDataBase::lookForAllTeacher();
        //Filter enseignant from module in BDD
        $enseignantsBDD = array();
        foreach ($enseignants as $enseignant) {
            // Ajouter au tab de l'enseignant le module a true si il possede le module recuperé en get
            $modules = $enseignant->getModule();
            foreach ($modules as $key => $value) {
                if ($getParameters["module"] == $value->getName()) {
                    $enseignantsBDD[] = $enseignant->getId();
                }
            }
        }
        // add module user
        $listToAdd = array_diff($enseignantsFromPost, $enseignantsBDD);
        foreach ($listToAdd as $add) {
            $user = ControllerUserDataBase::lookForSpecificUser($add);
            $controllerUser = new ControllerUserDataBase($user);
            $module = ControllerModuleDataBase::lookForModule($getParameters["module"]);

            $controllerUser->addModuleUser($module);
        }
        $listToRemove = array_diff($enseignantsBDD, $enseignantsFromPost);
        // remove module user
        foreach ($listToRemove as $remove) {
            // echo $r;
            $user = ControllerUserDataBase::lookForSpecificUser($remove);
            $controllerUser = new ControllerUserDataBase($user);
            $module = ControllerModuleDataBase::lookForModule($getParameters["module"]);
            $controllerUser->removeModuleUser($module);
        }

        $this->m_viewAdminModuleMenuSubscibe->setModule($getParameters["module"]);
        $this->m_viewAdminModuleMenuSubscibe->render();

    }

    public function setModuleInscriptionsEtudiants($getParameters)
    {
        $etudiantsFromPost = array();
        foreach ($_POST as $k => $v) {
            $etudiantsFromPost[] = $k;
        }

        $etudiants = ControllerUserDataBase::lookForAllStudents();
        //Filter etudiant from module in BDD
        $etudiantsBDD = array();
        foreach ($etudiants as $etudiant) {
            // Ajouter au tab de l'etudiant le module a true si il possede le module recuperé en get
            $modules = $etudiant->getModule();
            foreach ($modules as $key => $value) {
                if ($getParameters["module"] == $value->getName()) {
                    $etudiantsBDD[] = $etudiant->getId();
                }
            }
        }
        // add module user
        $listToAdd = array_diff($etudiantsFromPost, $etudiantsBDD);
        foreach ($listToAdd as $add) {
            $user = ControllerUserDataBase::lookForSpecificUser($add);
            $controllerUser = new ControllerUserDataBase($user);
            $module = ControllerModuleDataBase::lookForModule($getParameters["module"]);

            $controllerUser->addModuleUser($module);
        }
        $listToRemove = array_diff($etudiantsBDD, $etudiantsFromPost);
        // remove module user
        foreach ($listToRemove as $remove) {
            // echo $r;
            $user = ControllerUserDataBase::lookForSpecificUser($remove);
            $controllerUser = new ControllerUserDataBase($user);
            $module = ControllerModuleDataBase::lookForModule($getParameters["module"]);
            $controllerUser->removeModuleUser($module);
        }

        $this->m_viewAdminModuleMenuSubscibe->setModule($getParameters["module"]);
        $this->m_viewAdminModuleMenuSubscibe->render();

    }


}
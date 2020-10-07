<?php

include_once("src/globals/PageIdentifiers.php");
include_once("src/controllers/ControllerModuleList.php");
include_once("src/controllers/ControllerModule.php");
include_once("src/controllers/ControllerConnection.php");
include_once("src/views/ViewHelloWorld.php");
include_once("src/views/ViewHome.php");
include_once("src/controllers/ControllerAbsenceDetails.php");
include_once("src/controllers/ControllerAbsenceList.php");
include_once("src/controllers/ControllerEtudiantList.php");
include_once("src/controllers/ControllerEtudiantEdit.php");
include_once("src/controllers/ControllerEnseignantList.php");
include_once("src/controllers/ControllerEnseignantEdit.php");
include_once("src/controllers/ControllerAlert.php");
include_once("src/controllers/ControllerDisconnection.php");
include_once("src/controllers/ControllerAdministration.php");
include_once("src/controllers/ControllerAdminModuleList.php");

$path=$_SERVER['DOCUMENT_ROOT']."/M2-TF-GR7/src";

// We do a first sanitization pass by removing HTML tags
$sanitizedGet = [];

//We start the session $_SESSION[]
session_start();

foreach ($_GET as $key => $value)
{
    $sanitizedGet[$key] = filter_var($value, FILTER_SANITIZE_STRING);
}



//If no user is connected, the Connection page is the default page, else is the Home page
if(isset($_SESSION['user'])){
    $requestedPage = PAGE_ID_HOME;
}else{
    $requestedPage = PAGE_ID_CONNECTION;
}


if (isset($sanitizedGet["page"]))
{
    $requestedPage = $sanitizedGet["page"];
}
//echo $requestedPage;
// Dispatch to controllers
if ($requestedPage === PAGE_ID_HELLO_WORLD)
{
    // Hello world is a dummy page so no controller is needed
    $helloWorldView = new ViewHelloWorld();
    $helloWorldView->render();
}
else if ($requestedPage === PAGE_ID_CONNECTION)
{
    $controller = new ControllerConnection();
    $controller->connection();
}
else if ($requestedPage === PAGE_ID_HOME)
{
    $homeView = new ViewHome();
    $homeView->render();
}
else if ($requestedPage === PAGE_ID_DISCONNECTION)
{
    $controller = new ControllerDisconnection();
    $controller->disconnection();
}
else if ($requestedPage === PAGE_ID_MODULE_LIST)
{
    $controller = new ControllerModuleList();
    $controller->handleRequest($sanitizedGet);
}
else if ($requestedPage === PAGE_ID_MODULE)
{
    $controller = new ControllerModule();
    $controller->handleRequest($sanitizedGet);
}

else if($requestedPage === PAGE_ID_ABSENCE_LIST) {
    $controller = new ControllerAbsenceList();
    $controller->handleRequest($sanitizedGet);   
}

else if($requestedPage === PAGE_ID_ABSENSE_DETAIL) {
    $controller = new ControllerAbsenceDetails();
    $controller->handleRequest($sanitizedGet); 
}
else if($requestedPage === PAGE_ID_ETUDIANT_LIST) {
    $controller = new ControllerEtudiantList();
    $controller->handleRequest($sanitizedGet);
}
else if($requestedPage === PAGE_ID_ETUDIANT_EDIT) {
    $controller = new ControllerEtudiantList();
    $controller->editEtudiant($sanitizedGet);
}
else if($requestedPage === PAGE_ID_MODULE_EDIT) {
    $controller = new ControllerAdminModuleList();
    $controller->editModule($sanitizedGet);
}
else if($requestedPage === PAGE_ID_ENSEIGNANT_LIST) {
    $controller = new ControllerEnseignantList();
    $controller->handleRequest($sanitizedGet);
}

else if($requestedPage === PAGE_ID_ENSEIGNANT_EDIT) {
    $controller = new ControllerEnseignantList();
    $controller->editEnseignant($sanitizedGet);
}
else if($requestedPage === PAGE_ID_ADD_ABSENSE_DETAIL) {
    //echo "Page Running";
    $controller = new ControllerAbsenceDetails();
    $controller->AddRequest($sanitizedGet);
}
else if($requestedPage === AJAX_LOAD_ABSENCE_DETAILS) {
    //echo "Page Running";
    //$controller = new ControllerAbsenceDetails();
    //$controller->AddRequest($sanitizedGet);
    include_once($path . "/controllers/ControllerAbsenceDetails.php");
    $obj = new ControllerAbsenceDetails();
    $obj->reload();
}
else if($requestedPage === AJAX_ADD_ABSENCE_DETAILS) {
    //echo "Page Running";
    //$controller = new ControllerAbsenceDetails();
    //$controller->AddRequest($sanitizedGet);
    include_once($path . "/controllers/ControllerAbsenceDetails.php");
    $obj = new ControllerAbsenceDetails();
    $obj->add_student();
}
else if($requestedPage === AJAX_EDIT_ABSENCE_DETAILS) {
    //echo "Page Running";
    //$controller = new ControllerAbsenceDetails();
    //$controller->AddRequest($sanitizedGet);
    include_once($path . "/controllers/ControllerAbsenceDetails.php");
    $obj = new ControllerAbsenceDetails();
    $obj->modify_student();
}
else if($requestedPage === AJAX_DELETE_ABSENCE_DETAILS) {
    //echo "Page Running";
    //$controller = new ControllerAbsenceDetails();
    //$controller->AddRequest($sanitizedGet);
    include_once($path . "/controllers/ControllerAbsenceDetails.php");
    $obj = new ControllerAbsenceDetails();
    $obj->delete_student();
}
else if ($requestedPage === PAGE_ID_ALERT)
{
    $controller = new ControllerAlert();
    $controller->handleRequest();
}

else if ($requestedPage === PAGE_ID_ADMINISTRATION)
{
    $controller = new ControllerAdministration();
    $controller->handleRequest($sanitizedGet);
}
else if ($requestedPage === PAGE_ID_ADMIN_MODULE_LIST)
{
    $controller = new ControllerAdminModuleList();
    $controller->handleRequest($sanitizedGet);
}
else if ($requestedPage === DELETE_ADMIN_MODULE)
{
    $controller = new ControllerAdminModuleList();
    $controller->deleteModule($sanitizedGet);
}
else if ($requestedPage === ADD_ADMIN_MODULE)
{
    $controller = new ControllerAdminModuleList();
    $controller->addAdminModule($sanitizedGet);
}


else if ($requestedPage === DELETE_ADMIN_ENSEIGNANT)
{
    $controller = new ControllerEnseignantList();
    $controller->deleteEnseignant($sanitizedGet);
}
else if ($requestedPage === DELETE_ADMIN_ETUDIANT)
{
    $controller = new ControllerEtudiantList();
    $controller->deleteEtudiant($sanitizedGet);
}
else if ($requestedPage === ADD_ADMIN_ETUDIANT)
{
    $controller = new ControllerEtudiantList();
    $controller->addEtudiant($sanitizedGet);
}
else if ($requestedPage === ADD_ADMIN_ENSEIGNANT)
{
    $controller = new ControllerEnseignantList();
    $controller->addEnseignant($sanitizedGet);
}
else if ($requestedPage === MODIFY_ADMIN_ETUDIANT)
{
    $controller = new ControllerEtudiantList();
    $controller->modifyAdminEtudiant($sanitizedGet);
}
else if ($requestedPage === MODIFY_ADMIN_ENSEIGNANT)
{
    $controller = new ControllerEnseignantList();
    $controller->modifyAdminEnseignant($sanitizedGet);
}

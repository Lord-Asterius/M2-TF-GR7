<?php

include_once("src/globals/PageIdentifiers.php");
include_once("src/controllers/ControllerModuleList.php");
include_once("src/controllers/ControllerModule.php");
include_once("src/controllers/ControllerConnection.php");
include_once("src/views/ViewHelloWorld.php");
include_once("src/controllers/ControllerAbsenceDetails.php");
include_once("src/controllers/ControllerAbsenceList.php");
include_once("src/controllers/ControllerEtudiantList.php");
include_once("src/controllers/ControllerEtudiantEdit.php");
include_once("src/controllers/ControllerEnseignantList.php");
include_once("src/controllers/ControllerEnseignantEdit.php");
include_once("src/controllers/ControllerAlert.php");



// We do a first sanitization pass by removing HTML tags
$sanitizedGet = [];
foreach ($_GET as $key => $value)
{
    $sanitizedGet[$key] = filter_var($value, FILTER_SANITIZE_STRING);
}



//the Connection page as the default page
$requestedPage = PAGE_ID_CONNECTION;

if (isset($sanitizedGet["page"]))
{
    $requestedPage = $sanitizedGet["page"];
}

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
    $controller->connection($sanitizedGet);
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
##by Khadija
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
    $controller = new ControllerEtudiantEdit();
    $controller->handleRequest($sanitizedGet);
}
else if($requestedPage === PAGE_ID_ENSEGNANT_LIST) {
    $controller = new ControllerEnseignantList();
    $controller->handleRequest($sanitizedGet);
}
else if($requestedPage === PAGE_ID_ENSEIGNANT_EDIT) {
    $controller = new ControllerEnseignantEdit();
    $controller->handleRequest($sanitizedGet);
}
else if ($requestedPage === PAGE_ID_ALERT)
{
    $controller = new ControllerAlert();
    $controller->handleRequest($sanitizedGet);
}


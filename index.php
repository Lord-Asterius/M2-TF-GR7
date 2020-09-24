<?php

include_once("src/controllers/ControllerModuleList.php");
include_once("src/views/ViewHelloWorld.php");


// We do a first sanitization pass by removing HTML tags and characters outside of the ASCII table
$sanitizedGet = [];
foreach ($_GET as $key => $value)
{
    $sanitizedGet[$key] = filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
}


// Retrieve the requested page, Hello world is set as the default page for now
$requestedPage = "helloWorld";
if (isset($sanitizedGet["page"]))
{
    $requestedPage = $sanitizedGet["page"];
}

// Dispatch to controllers
if ($requestedPage === "helloWorld")
{
    // Hello world is a dummy page so no controller is needed
    $helloWorldView = new ViewHelloWorld();
    $helloWorldView->render();
}
else if ($requestedPage === "moduleList")
{
    $controller = new ControllerModuleList();
    $controller->handleRequest($sanitizedGet);
}

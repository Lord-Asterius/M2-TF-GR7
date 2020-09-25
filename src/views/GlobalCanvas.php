<?php

include_once(dirname(__FILE__) . "/../globals/PageIdentifiers.php");


class GlobalCanvas
{
    private $m_pageTitle;
    private $m_siteTitle;
    private $m_pageIdentifier;

    public function __construct($pageTitle, $pageIdentifier)
    {
        $this->m_pageTitle = $pageTitle;
        $this->m_pageIdentifier = $pageIdentifier;
        $this->m_siteTitle = "Qui est là ?";
    }

    public function renderTemplate($templateName, $context)
    {
        $templatePath = dirname(__FILE__) . "/../../templates/" . $templateName . ".html";
        include(dirname(__FILE__) . "/../../templates/canvas.html");
    }

    private function getActiveStatusForPage($pageIdentifier)
    {
        if ($pageIdentifier === $this->m_pageIdentifier)
        {
            return "active";
        }

        return "";
    }
}
<?php


class GlobalCanvas
{
    private $m_pageTitle;
    private $m_siteTitle;

    public function __construct($pageTitle)
    {
        $this->m_pageTitle = $pageTitle;
        $this->m_siteTitle = "Qui est là ?";
    }

    public function renderTemplate($templatePath, $context)
    {
        include(dirname(__FILE__) . "/../templates/canvas.html");
    }
}
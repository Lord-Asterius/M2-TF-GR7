<?php


class ViewAlert
{
    private $m_canvas;
    private $m_context;

    public function __construct()
    {
        $this->m_canvas = new GlobalCanvas("Liste des alertes", PAGE_ID_ALERT);
        $this->m_context = [];
    }

    public function setAlertList($alert)
    {
        $this->m_context["alert"] = $alert;;
    }
    public function render()
    {
        $this->m_canvas->renderTemplate("alert", $this->m_context);
    }
}
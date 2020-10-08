<?php

include_once(dirname(__FILE__) . "/GlobalCanvas.php");


class ViewAbsenceAdd
{
    private $m_canvas;
    private $m_context;

    public function __construct()
    {
        $this->m_canvas = new GlobalCanvas("Edition d'un module", PAGE_ID_ABSENCE_ADD);
        $this->m_context = [];
    }

    public function setModuleEdit($attendanceData)
    {
        $this->m_context["attendanceData"] = $attendanceData;
    }

    public function render()
    {
        $this->m_canvas->renderTemplate("absenceAdd", $this->m_context);
    }
}
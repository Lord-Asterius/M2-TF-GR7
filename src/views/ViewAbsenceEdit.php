<?php

include_once(dirname(__FILE__) . "/GlobalCanvas.php");


class ViewAbsenceEdit
{
    private $m_canvas;
    private $m_context;

    public function __construct()
    {
        $this->m_canvas = new GlobalCanvas("Edition d'un module", PAGE_ID_ABSENCE_EDIT);
        $this->m_context = [];
    }

    public function setAbsenceData($attendanceData)
    {
        $this->m_context["attendanceData"] = $attendanceData;
    }

    public function render()
    {
        $this->m_canvas->renderTemplate("absenceEdit", $this->m_context);
    }
}
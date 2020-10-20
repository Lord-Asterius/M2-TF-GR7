<?php

include_once(dirname(__FILE__) . "/GlobalCanvas.php");


class ViewAbsenceList
{
    private $m_canvas;
    private $m_context;

    public function __construct()
    {
        $this->m_canvas = new GlobalCanvas("Liste des absences", PAGE_ID_ABSENCE_LIST);
        $this->m_context = [];
    }

    public function setAttendanceData($attendanceData)
    {
        $this->m_context["attendanceData"] = $attendanceData;
      
    }

    public function render()
    {
        $this->m_canvas->renderTemplate("absenceList", $this->m_context);
    }
}
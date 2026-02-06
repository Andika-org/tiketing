<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/tcpdf/tcpdf.php';
class TCPDF_lib extends TCPDF
{
    public function __construct()
    {
        $this->pdf = new TCPDF();
        $this->pdf->SetAutoPageBreak(TRUE, 15);
        $this->pdf->SetFont('helvetica', '', 9);
        $this->pdf->SetPrintHeader(false);
    }

    public function generate_pdf($html, $filename)
    {
        $this->pdf->AddPage();
        $this->pdf->writeHTML($html, true, false, true, false, '');
        $this->pdf->Output($filename, 'I');
    }

    public function save_pdf($html, $filename)
    {
        $this->pdf->AddPage();
        $this->pdf->writeHTML($html, true, false, true, false, '');
        $this->pdf->Output($filename, 'F');
    }

    public function generate_pdf_a5($html, $filename)
    {
        $this->pdf->AddPage();
        $this->pdf->writeHTML($html, true, false, true, false, '');
        $this->pdf->Output($filename, 'I');
    }

    public function generate_multiHalaman($html_pages, $filename)
    {
        $this->pdf->SetMargins(5, 5, 5);
        $this->pdf->SetAutoPageBreak(TRUE, 5);

        $this->pdf->SetFont('helvetica', '', 6);
        foreach ($html_pages as $index => $html_page) {
            $this->pdf->AddPage('L', array(65, 40));
            if ($index === 0) {
                $this->pdf->SetY(10);
            } else {
                $this->pdf->SetY(10);
            }

            $this->pdf->writeHTML($html_page, true, false, true, false, '');
        }

        $this->pdf->Output($filename, 'I');
    }



    // LEBIH DARI 1 HALAMAN 
    public function generate_satu_page($html_page_1, $filename)
    {
        $this->pdf->AddPage();
        $this->pdf->writeHTML($html_page_1, true, false, true, false, '');

        $this->pdf->Output($filename, 'I');
    }

    public function generate_satu_page_l($html_page_1, $filename)
    {
        $this->pdf->SetFont('helvetica', '', 8);
        $this->pdf->SetMargins(2, 2, 2);
        $this->pdf->SetAutoPageBreak(TRUE, 2);
        $this->pdf->AddPage('L');
        $this->pdf->writeHTML($html_page_1, true, false, true, false, '');

        $this->pdf->Output($filename, 'I');
    }

    public function generate_thermal_page($html, $filename)
    {
        $this->pdf->AddPage('P', array(65, 40));
        $this->pdf->writeHTML($html, true, false, true, false, '');

        $this->pdf->Output($filename, 'I');
    }

    public function generate_dua_page($html_page_1, $html_page_2, $filename)
    {
        $this->pdf->AddPage();
        $this->pdf->writeHTML($html_page_1, true, false, true, false, '');

        $this->pdf->AddPage();
        $this->pdf->writeHTML($html_page_2, true, false, true, false, '');

        $this->pdf->Output($filename, 'I');
    }

    public function generate_tiga_page($html_page_1, $html_page_2, $html_page_3, $filename)
    {
        $this->pdf->AddPage();
        $this->pdf->writeHTML($html_page_1, true, false, true, false, '');

        $this->pdf->AddPage();
        $this->pdf->writeHTML($html_page_2, true, false, true, false, '');

        $this->pdf->AddPage();
        $this->pdf->writeHTML($html_page_3, true, false, true, false, '');

        $this->pdf->Output($filename, 'I');
    }

    public function generate_empat_page($html_page_1, $html_page_2, $html_page_3, $html_page_4, $filename)
    {
        $this->pdf->AddPage();
        $this->pdf->writeHTML($html_page_1, true, false, true, false, '');

        $this->pdf->AddPage();
        $this->pdf->writeHTML($html_page_2, true, false, true, false, '');

        $this->pdf->AddPage();
        $this->pdf->writeHTML($html_page_3, true, false, true, false, '');

        $this->pdf->AddPage();
        $this->pdf->writeHTML($html_page_4, true, false, true, false, '');

        $this->pdf->Output($filename, 'I');
    }
}

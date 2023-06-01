<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use PDF;
use TCPDF;
use TPDF;

class PdfController extends Controller
{
    //
    public function generatePDF()
    {
        try {
            $pdf = new TCPDF();
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
            $spreadsheet = $reader->load(storage_path("Phoilichhen.xlsx"))->convert();
            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Html');
            // $excelHtml = $writer->generateSheetData();
            // $pdf = PDF::loadHtml($excelHtml);
            $html = '<h1>HTML Example</h1>
            <h2>List</h2>
            List example:
                        <ol>
                <li><img src="images/logo_example.png" alt="test alt attribute" width="30" height="30" border="0" /> test image</li>
                <li><b>bold text</b></li>
                <li><i>italic text</i></li>
                <li><u>underlined text</u></li>
                <li><b>b<i>bi<u>biu</u>bi</i>b</b></li>
                <ol>';
            $pdf->setSourceFile();
            $pdf->SetFont('helvetica', '', 12);
            $pdf->AddPage();
            $pdf->writeHTML($html);
            $pdf->Image(storage_path("chungthuc_ok.png"),15,35,'','','PNG','',true);
            // $pdf->render();
            $pdf->Output(storage_path("phieu_lich_hen_ok.pdf"), 'F');
            // $output->save(storage_path("phieu_lich_hen.pdf"));
            return 1;
        } catch (Exception $e) {
            return $e;
        }
    }
}

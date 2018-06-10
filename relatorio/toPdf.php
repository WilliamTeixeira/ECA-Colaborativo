<?php
/**
 * Description of graphicToPdf
 * exportar grafico para pdf
 * 
 * @author wtx
 */
require_once "../vendor/autoload.php";
require_once "../lib/mem_image.php";

class toPdf {
    
    function pdf($grafico){
        $pdf = new PDF_MemImage();
        $pdf->AddPage();
        $pdf->GDImage($grafico->img, 30, 20, 140);
        $pdf->Output();
    }

}

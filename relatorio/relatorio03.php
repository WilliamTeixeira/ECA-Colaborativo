<?php

ini_set('display_errors', 0);

require_once  "../vendor/autoload.php";
require_once "../dao/relatorioDAO.php";

$dao = new relatorioDAO();

$listObjs = $dao->relatorio03();
$dia = $dao ->dataAtual();
$hr = $dao ->horaAtual();

$html = "<table border='1' cellspacing='3' cellpadding='4' >";
$html .= "<tr>
            <th>ID PAYMENT</th>
            <th>CITY</th>
            <th>FUNCTIONO</th>
            <th>SUB-FUNCTION</th>
            <th>PROGRAM</th>
            <th>ACTION</th>
            <th>BENEFICIARIES</th>
            <th>NIS</th>
            <th>FILE</th>
        </tr>";
foreach ($listObjs as $var):
    $html.= "<tr>
                <td>$var->a1</td>
                <td>$var->a2</td>
                <td>$var->a3</td>
                <td>$var->a4</td>
                <td>$var->a5</td>
                <td>$var->a6</td>
                <td>$var->a7</td>
                <td>$var->a8</td>
                <td>$var->a9</td>
          </tr>";
endforeach;
$html .= "</table>";

$mpdf=new \Mpdf\Mpdf();
//$mpdf=new mPDF();
$mpdf->SetCreator(PDF_CREATOR);
$mpdf->SetAuthor('Hugo Nogueira Pinto');
$mpdf->SetTitle('PDF report with list of payments including their respective data');
$mpdf->SetSubject('System EconomiC Analyzer');
$mpdf->SetKeywords('TCPDF, PDF, trabalho PHP');
$mpdf->SetDisplayMode('fullpage');
$mpdf->nbpgPrefix = ' de ';
$mpdf->setFooter("Report generated on {$dia} at {$hr} - Page {PAGENO}{nbpg}");
$mpdf->WriteHTML($html);
$mpdf->Output('economicAnalyzer.pdf','I');

exit;

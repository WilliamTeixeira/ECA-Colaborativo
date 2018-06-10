<?php

//So funciona se desativar os erros!
ini_set('display_errors', 0);

require_once  "../vendor/autoload.php";
require_once "../dao/relatorioDAO.php";

$dao = new relatorioDAO();

$listObjs = $dao->relatorio05();
$dia = $dao ->dataAtual();
$hr = $dao ->horaAtual();

$html = "<table border='1' cellspacing='3' cellpadding='4' >";
$html .= "<tr>
            <th>NAME OF BENEFICIARIES</th>
            <th>QUANTITY OF PAYMENTS</th>
            <th>TOTAL AMOUNT PAID</th>
            <th>MONTH</th>
            <th>YEAR</th>
        </tr>";
foreach ($listObjs as $var):
    $html.= "<tr>
                <td>$var->tb_beneficiaries</td>
                <td>$var->QTD</td>
                <td>$var->SOMA</td>
                <td>$var->int_month</td>
                <td>$var->int_year</td>
          </tr>";
endforeach;
$html .= "</table>";


$mpdf=new \Mpdf\Mpdf();
//$mpdf=new mPDF();
$mpdf->SetCreator(PDF_CREATOR);
$mpdf->SetAuthor('Hugo Nogueira Pinto');
$mpdf->SetTitle('PDF report with the sum of times the beneficiary has received help, the months that were and the values of each month');
$mpdf->SetSubject('System EconomiC Analyzer');
$mpdf->SetKeywords('TCPDF, PDF, trabalho PHP');
$mpdf->SetDisplayMode('fullpage');
$mpdf->nbpgPrefix = ' de ';
$mpdf->setFooter("Report generated on {$dia} at {$hr} - Page {PAGENO}{nbpg}");
$mpdf->WriteHTML($html);
$mpdf->Output('economicAnalyzer.pdf','I');

exit;

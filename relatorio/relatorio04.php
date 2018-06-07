<?php

//So funciona se desativar os erros!
ini_set('display_errors', 0);

require_once  "../vendor/autoload.php";
//include("../libs/mpdf/mpdf.php");
//require_once "../lib/mpdf/mpdf.php";
require_once "../dao/relatorioDAO.php";

$dao = new relatorioDAO();

$listObjs = $dao->relatorio04();
$dia = $dao ->dataAtual();
$hr = $dao ->horaAtual();

$html = "<table border='1' cellspacing='3' cellpadding='3' >";
$html .= "<tr>
            <th>VALOR TOTAL PAGO</th>
            <th>NOME DA CIDADE</th>
            <th>NUMERO DE BENEFICIARIES</th>
        </tr>";
foreach ($listObjs as $var):
    $html.= "<tr>
                <td>$var->soma</td>
                <td>$var->nome</td>
                <td>$var->contador</td>
            </tr>";
endforeach;
$html .= "</table>";

$mpdf=new \Mpdf\Mpdf();
//$mpdf=new mPDF();
$mpdf->SetCreator(PDF_CREATOR);
$mpdf->SetAuthor('Hugo Nogueira Pinto');
$mpdf->SetTitle('Relatório PDF com o número de beneficiário por cidade e o valor total pago por cidade, por mês, ordenados por valor total decrescente');
$mpdf->SetSubject('Sistema EconomiC Analyzer');
$mpdf->SetKeywords('TCPDF, PDF, trabalho PHP');
$mpdf->SetDisplayMode('fullpage');
$mpdf->nbpgPrefix = ' de ';
$mpdf->setFooter("Relatório gerado no dia {$dia} às {$hr} - Página {PAGENO}{nbpg}");
$mpdf->WriteHTML($html);
$mpdf->Output('economicAnalyzer.pdf','I');

exit;

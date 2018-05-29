<?php

//So funciona se desativar os erros!
ini_set('display_errors', 0);

//include("../libs/mpdf/mpdf.php");
require_once "../lib/mpdf/mpdf.php";
require_once "../dao/relatorioDAO.php";

$dao = new relatorioDAO();

$listObjs = $dao->relatorio04();

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

$mpdf=new mPDF();
$mpdf->SetCreator(PDF_CREATOR);
$mpdf->SetAuthor('Tassio Sirqueira');
$mpdf->SetTitle('TCPDF Exemplo');
$mpdf->SetSubject('TCPDF Aula');
$mpdf->SetKeywords('TCPDF, PDF, exemplo');
$mpdf->SetDisplayMode('fullpage');
$mpdf->nbpgPrefix = ' de ';
$mpdf->setFooter('Página {PAGENO}{nbpg}');
$mpdf->WriteHTML($html);
$mpdf->Output('Exemplo.pdf','I');

exit;
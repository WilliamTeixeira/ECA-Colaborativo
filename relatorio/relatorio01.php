<?php

//So funciona se desativar os erros!
ini_set('display_errors', 0);

//include("../libs/mpdf/mpdf.php");
require_once "../lib/mpdf/mpdf.php";
require_once "../dao/relatorioDAO.php";

$dao = new relatorioDAO();

$listObjs = $dao->relatorio01();
$dia = $dao ->dataAtual();
$hr = $dao ->horaAtual();

$html = "<table border='1' cellspacing='3' cellpadding='4' >";
$html .= "<tr>
            <th>ID BENEFICIARIES</th>
            <th>CODIGO NIS</th>
            <th>NOME DO BENEFICIARIES</th>
        </tr>";
foreach ($listObjs as $var):
    $html.= "<tr>
                <td>$var->id_beneficiaries</td>
                <td>$var->str_nis</td>
                <td>$var->str_name_person</td>
          </tr>";
endforeach;
$html .= "</table>";
$html .= "<p>Relatório gerado no dia $dia às $hr</p>";

$mpdf=new mPDF();
$mpdf->SetCreator(PDF_CREATOR);
$mpdf->SetAuthor('Hugo Nogueira Pinto');
$mpdf->SetTitle('Relatório PDF com a lista de todos os beneficiários e seus respectivos dados em ordem alfabética');
$mpdf->SetSubject('Sistema EconomiC Analyzer');
$mpdf->SetKeywords('TCPDF, PDF, trabalho PHP');
$mpdf->SetDisplayMode('fullpage');
$mpdf->nbpgPrefix = ' de ';
$mpdf->setFooter('Página {PAGENO}{nbpg}');
$mpdf->WriteHTML($html);
$mpdf->Output('economicAnalyzer.pdf','I');

exit;
<?php

//So funciona se desativar os erros!
ini_set('display_errors', 0);

require_once  "../vendor/autoload.php";
//include("../libs/mpdf/mpdf.php");
//require_once "../lib/mpdf/mpdf.php";
require_once "../dao/relatorioDAO.php";

$dao = new relatorioDAO();

$listObjs = $dao->relatorio02();
$dia = $dao ->dataAtual();
$hr = $dao ->horaAtual();

$html = "<table border='1' cellspacing='3' cellpadding='3' >";
$html .= "<tr>
            <th>ID BENEFICIARIES</th>
            <th>NOME DO BENEFICIARIES</th>
            <th>CODIGO NIS</th>
            <th>ID CIDADE</th>
            <th>NOME CIDADE</th>
            <th>CODIGO SIAFI</th>
            <th>ID ESTADO</th>
        </tr>";
foreach ($listObjs as $var):
    $html.= "<tr>
                <td>$var->id_beneficiaries</td>
                <td>$var->str_name_person</td>
                <td>$var->str_nis</td>
                <td>$var->id_city</td>
                <td>$var->str_name_city</td>
                <td>$var->str_cod_siafi_city</td>
                <td>$var->tb_state_id_state</td>
          </tr>";
endforeach;
$html .= "</table>";
$html .= "<p>Relatório gerado no dia $dia às $hr</p>";

$mpdf=new \Mpdf\Mpdf();
//$mpdf=new mPDF();
$mpdf->SetCreator(PDF_CREATOR);
$mpdf->SetAuthor('Hugo Nogueira Pinto');
$mpdf->SetTitle('Relatório PDF com a lista de todos os beneficiários e a cidade a qual pertencem, com todos os dados do benefiário e da cidada, ordenados por cidade e posteriormente por nome do beneficário');
$mpdf->SetSubject('Sistema EconomiC Analyzer');
$mpdf->SetKeywords('TCPDF, PDF, trabalho PHP');
$mpdf->SetDisplayMode('fullpage');
$mpdf->nbpgPrefix = ' de ';
$mpdf->setFooter('Página {PAGENO}{nbpg}');
$mpdf->WriteHTML($html);
$mpdf->Output('economicAnalyzer.pdf','I');

exit;
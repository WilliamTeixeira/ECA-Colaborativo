<?php

//So funciona se desativar os erros!
ini_set('display_errors', 0);

//include("../libs/mpdf/mpdf.php");
require_once "../lib/mpdf/mpdf.php";
require_once "../dao/relatorioDAO.php";

$dao = new relatorioDAO();

$listObjs = $dao->relatorio02();

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
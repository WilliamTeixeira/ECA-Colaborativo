<?php

//So funciona se desativar os erros!
ini_set('display_errors', 0);

//include("../libs/mpdf/mpdf.php");
require_once "../lib/mpdf/mpdf.php";
require_once "../dao/relatorioDAO.php";

$dao = new relatorioDAO();

$listObjs = $dao->relatorio01();

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
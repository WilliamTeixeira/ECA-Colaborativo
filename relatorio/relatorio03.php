<?php

//So funciona se desativar os erros!
ini_set('display_errors', 0);

//include("../libs/mpdf/mpdf.php");
require_once "../lib/mpdf/mpdf.php";
require_once "../dao/relatorioDAO.php";

$dao = new relatorioDAO();

$listObjs = $dao->relatorio03();

$html = "<table border='1' cellspacing='3' cellpadding='4' >";
$html .= "<tr>
            <th>ID PAGAMENTO</th>
            <th>CIDADE</th>
            <th>FUNÇÃO</th>
            <th>SUB-FUNCAO</th>
            <th>PROGRAMA</th>
            <th>AÇÃO</th>
            <th>BENEFICIARIES</th>
            <th>NIS</th>
            <th>ARQUIVO</th>
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
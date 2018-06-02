<?php

//So funciona se desativar os erros!
ini_set('display_errors', 0);

//include("../libs/mpdf/mpdf.php");
require_once "../lib/mpdf/mpdf.php";
require_once "../dao/relatorioDAO.php";

$dao = new relatorioDAO();

$listObjs = $dao->relatorio05();
$dia = $dao ->dataAtual();
$hr = $dao ->horaAtual();

$html = "<table border='1' cellspacing='3' cellpadding='4' >";
$html .= "<tr>
            <th>NOME DO BENEFICIARIES</th>
            <th>QUANTIDADE DE PAGAMENTOS</th>
            <th>VALOR TOTAL PAGO</th>
            <th>MÊS</th>
            <th>ANO</th>
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
$html .= "<p>Relatório gerado no dia $dia às $hr</p>";


$mpdf=new mPDF();
$mpdf->SetCreator(PDF_CREATOR);
$mpdf->SetAuthor('Hugo Nogueira Pinto');
$mpdf->SetTitle('Relatório PDF com a soma de vezes que o benefiário ganhou auxilio, os meses que foram e os valores de cada mês');
$mpdf->SetSubject('Sistema EconomiC Analyzer');
$mpdf->SetKeywords('TCPDF, PDF, trabalho PHP');
$mpdf->SetDisplayMode('fullpage');
$mpdf->nbpgPrefix = ' de ';
$mpdf->setFooter('Página {PAGENO}{nbpg}');
$mpdf->WriteHTML($html);
$mpdf->Output('economicAnalyzer.pdf','I');

exit;
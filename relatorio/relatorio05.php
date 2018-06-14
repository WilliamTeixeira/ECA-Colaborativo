<?php
ini_set('display_errors', 0);

require_once  "../vendor/autoload.php";
require_once "../dao/relatorioDAO.php";

session_start();
        if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['password']) == true))
        {
            unset($_SESSION['login']);
            unset($_SESSION['password']);
    header('location:http://localhost/ECA-Colaborativo/login.php');
        }else{

$dao = new relatorioDAO();

$listObjs = $dao->relatorio05();
$dia = $dao ->dataAtual();
$hr = $dao ->horaAtual();

        $html = "<table border='2' cellspacing='3' cellpadding='5' >";
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
                <td>$var->count</td>
                <td>$var->sum</td>
                <td>$var->int_month</td>
                <td>$var->int_year</td>
          </tr>";
endforeach;
$html .= "</table>";


$mpdf=new \Mpdf\Mpdf();
$mpdf->SetCreator(PDF_CREATOR);
$mpdf->SetAuthor('Hugo Nogueira Pinto');
$mpdf->SetTitle('Relatório PDF com a soma de vezes que o benefiário ganhou auxilio, os meses que foram e os valores de cada mês');
$mpdf->SetSubject('Sistema EconomiC Analyzer');
$mpdf->SetKeywords('TCPDF, PDF, trabalho PHP');
$mpdf->SetDisplayMode('fullpage');
$mpdf->nbpgPrefix = ' de ';
$mpdf->setFooter("Relatório gerado no dia {$dia} às {$hr} - Página {PAGENO}{nbpg}");
$mpdf->WriteHTML($html);
$mpdf->Output('economicAnalyzer.pdf','I');

exit;
        }

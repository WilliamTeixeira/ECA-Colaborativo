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
$dao->verificaLogin();

$listObjs = $dao->relatorio03();
$dia = $dao ->dataAtual();
$hr = $dao ->horaAtual();

        $html = "<table border='2' cellspacing='3' cellpadding='5' >";
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

$mpdf=new \Mpdf\Mpdf();
//$mpdf=new mPDF();
$mpdf->SetCreator(PDF_CREATOR);
$mpdf->SetAuthor('Hugo Nogueira Pinto');
$mpdf->SetTitle('Relatório PDF com a lista de os pagamentos, incluindo seus respectivos dados');
$mpdf->SetSubject('Sistema EconomiC Analyzer');
$mpdf->SetKeywords('TCPDF, PDF, trabalho PHP');
$mpdf->SetDisplayMode('fullpage');
$mpdf->nbpgPrefix = ' de ';
$mpdf->setFooter("Relatório gerado no dia {$dia} às {$hr} - Página {PAGENO}{nbpg}");
$mpdf->WriteHTML($html);
$mpdf->Output('economicAnalyzer.pdf','I');

exit;
        
        
}

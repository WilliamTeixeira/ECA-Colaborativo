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

        $listObjs = $dao->relatorio01();
        $dia = $dao ->dataAtual();
        $hr = $dao ->horaAtual();

        $html = "<table border='2' cellspacing='3' cellpadding='5' >";
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

        $mpdf=new \Mpdf\Mpdf();
        $mpdf->SetCreator(PDF_CREATOR);
        $mpdf->SetAuthor('Hugo Nogueira Pinto');
        $mpdf->SetTitle('Relatório PDF com a lista de todos os beneficiários e seus respectivos dados em ordem alfabética');
        $mpdf->SetSubject('Sistema EconomiC Analyzer');
        $mpdf->SetKeywords('TCPDF, PDF, trabalho PHP');
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->nbpgPrefix = ' de ';
        $mpdf->setFooter("Relatório gerado no dia {$dia} às {$hr} - Página {PAGENO}{nbpg}");
        $mpdf->WriteHTML($html);
        $mpdf->Output('economicAnalyzer.pdf','I');

        exit;
        
}
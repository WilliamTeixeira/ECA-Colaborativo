<?php
/**
 * Description of graficoTotalBenefMes
 * Série histórica, com o total de beneficiário por mês, por ano (Line Plot)
 * 
 * @author wtx
 */

require_once "../lib/PHPlot/phplot.php";
require_once "../db/conexao.php";

#Instancia o objeto e setando o tamanho do grafico na tela
$grafico = new PHPlot(900,300);
#Indicamos o títul do gráfico e o título dos dados no eixo X e Y do mesmo
$grafico->SetTitle("Beneficiarios por Mes e Ano");
$grafico->SetXTitle("Mes e Ano");
$grafico->SetYTitle("Numero Beneficiarios");

$query = "SELECT count(tb_beneficiaries_id_beneficiaries )as qtde, int_month as mes, int_year as ano
          FROM tb_payments group by int_month, int_year order by int_year asc, int_month asc;";
$statement = $pdo->prepare($query);

$statement->execute();
$rs = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($rs as $value) {
    $resultado[] = $value;
}
$data = array();
if(isset($resultado)) {
    foreach ($resultado as $r){
        $data[] = [ $r['ano'].'/'.$r['mes'], $r['qtde']];
    }
} else {
    $data[]=[null,null];
}
//$grafico->SetDefaultTTFont('assets/fonts/Timeless.ttf');
$grafico->SetDataValues($data);

$grafico->SetPlotType("lines");
#Exibimos o gráfico
$grafico->DrawGraph();

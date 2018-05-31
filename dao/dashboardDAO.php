<?php
/**
 * Description of dashboardDAO
 *
 * @author willi
 */
require_once "db/conexao.php";

class dashboardDAO {
    
    public function totalPagamento()
    {
        global $pdo;
        try {
            $statement = $pdo->prepare('SELECT count(id_payment) as qtde_pag, sum(db_value) as total_pag FROM tb_payments;');
            if ($statement->execute()) {
                $obj = $statement->fetchAll(PDO::FETCH_OBJ);
                return $obj;
            }else {
                throw new PDOException("<script> alert('Erro: Não foi possível executar a declaração sql'); </script>");
            }
        }catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }
    
    public function somaPagAtual()
    {
        global $pdo;
        try {
            $statement = $pdo->prepare('SELECT sum(db_value) as soma_pag FROM tb_payments where int_month = :month;');
            $date = getdate();
            $statement->bindValue(":month", $date['mon']);
            if ($statement->execute()) {
                $obj = $statement->fetchAll(PDO::FETCH_OBJ);
                return $obj;
            }else {
                throw new PDOException("<script> alert('Erro: Não foi possível executar a declaração sql'); </script>");
            }
        }catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }
    
    public function pagUltimoMes()
    {
        global $pdo;
        try {
            $statement = $pdo->prepare('SELECT count(id_payment) qtde, sum(db_value) soma, int_month mes, int_year ano FROM tb_payments group by int_month having int_month = max(int_month) and int_year = max(int_year);');
            if ($statement->execute()) {
                $rs = $statement->fetchAll(PDO::FETCH_OBJ);
                $array = array(
                        'qtde' => $rs[0]->qtde,
                        'soma' => $rs[0]->soma,
                        'mes'  => $rs[0]->mes,
                        'ano'  => $rs[0]->ano
                        );
                
                return $array;
               
            }else {
                throw new PDOException("<script> alert('Erro: Não foi possível executar a declaração sql'); </script>");
            }
        }catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }
    
    public function totalBeneficiarios()
    {
        global $pdo;
        try {
            $statement = $pdo->prepare('SELECT count(*) AS total FROM tb_beneficiaries;');
            if ($statement->execute()) {
                $rs = $statement->fetchAll(PDO::FETCH_ASSOC);
                $total;
                foreach ($rs as $value) {
                    if($value['total'])
                        $total = $value['total'];
                }
                return $total;
            }else {
                throw new PDOException("<script> alert('Erro: Não foi possível executar a declaração sql'); </script>");
            }
        }catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }
}
<?php
/**
 * Description of dashboardDAO
 *
 * @author willi
 */

require_once "db/conexao.php";
require_once "classes/dashboard.php";

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
                $obj = $statement->fetchAll(PDO::FETCH_OBJ);
                return $obj;
            }else {
                throw new PDOException("<script> alert('Erro: Não foi possível executar a declaração sql'); </script>");
            }
        }catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }
    
    public function totalBeneficiarios()
    {
        $obj = new dashboard();
        global $pdo;
        try {
            $statement = $pdo->prepare('SELECT count(*) AS total FROM tb_beneficiaries;');
            if ($statement->execute()) {
                $rs = $statement->fetch(PDO::FETCH_OBJ);
                $obj->setTotalBenef($rs->total);
                
                //$rs = $statement->fetchAll(PDO::FETCH_OBJ);
                //var_dump($rs);
                //$obj = $rs[0];
                //$total = $obj['total'];
                //var_dump($obj);
                var_dump($obj->getTotalBenef());
                return $obj;
            }else {
                throw new PDOException("<script> alert('Erro: Não foi possível executar a declaração sql'); </script>");
            }
        }catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }
}
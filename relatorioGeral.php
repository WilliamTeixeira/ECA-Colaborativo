<?php

require_once "classes/template.php";

//require_once "dao/cityDAO.php";
//require_once "classes/city.php";

//$object = new cityDAO();

$template = new Template();

$template->header();
$template->sidebar();
$template->mainpanel();
?>

<div class='content' xmlns="http://www.w3.org/1999/html">
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-12'>
                <div class='card'>
                    <div class='header'>
                        <h4 class='title'>Relatorio</h4>
                        <p class='category'>Lista de relatorios do sistema</p>

                    </div>
                    <div class='content table-responsive'>

                        <form action="?act=save&id=" method="POST" name="form1">

                            <input type="hidden" name="id" value="<?php
                            // Preenche o id no campo id com um valor "value"
                            echo (isset($id) && ($id != null || $id != "")) ? $id : '';
                            ?>"/>
                            Tipo de relatorio:
                            <select class="form-control" name="relatoriosDisponiveis">
                                <option value="relatorio1">Lista de todos os beneficiários</option>
                                <option value="relatorio2">Lista de todos os beneficiários juntamente com a cidade</option>
                                <option value="relatorio3">Lista com todos os pagamentos</option>
                                <option value="relatorio4">Lista com o número de beneficiários jutamente com cidade e o valor pago por mês</option>
                                <option value="relatorio5">Lista com a soma de vezes que o beneficiário ganhou auxiloi juntamente com os meses e os valores</option>
                                <option value="relatorio6">Lista com o total de pagamentos por região</option>
                                <option value="relatorio7">Lista com o total de pagamentos por estado</option>
                            </select>
                            <br/>

                            <input class="btn btn-success" type="submit" value="GERAR RELATORIO">
                            <hr>
                        </form>
                        
                        <?php
                        
                        $relatorioselecionado = $_POST['relatoriosDisponiveis'];
                        var_dump($relatorioselecionado);
                        if ($relatorioselecionado=="relatorio1") { 
                            //http://localhost/PHP/ECA-Colaborativo/relatorio/relatorio01.php
                        }else if ($relatorioselecionado=="relatorio2") { 
                            
                        }else if ($relatorioselecionado=="relatorio3") { 
                            
                        }else if ($relatorioselecionado=="relatorio4") { 
                            
                        }else if ($relatorioselecionado=="relatorio5") { 
                            
                        }else if ($relatorioselecionado=="relatorio6") { 
                            
                        }else if ($relatorioselecionado=="relatorio7") { 
                            
                        }

                        echo (isset($msg) && ($msg != null || $msg != "")) ? $msg : '';

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$template->footer();
?>

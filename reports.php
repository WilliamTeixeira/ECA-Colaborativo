<?php

require_once "lib/template.php";

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
                        <h4 class='title'>Report</h4>
                        <p class='category'>List of system reports</p>
                    </div>

                    <div class='content table-responsive'>
                        <form method="POST" name="form">                          
                            Report type:
                            <select class="form-control" name="relatoriosDisponiveis">
                                <option value="relatorioNulo">Select a report</option>
                                <option value="relatorio01">List of all beneficiaries</option>
                                <option value="relatorio02">List all beneficiaries together with the city</option>
                                <option value="relatorio03">List with all payments</option>
                                <option value="relatorio04">List with the number of beneficiaries along with city and the amount paid per month</option>
                                <option value="relatorio05">List with the sum of times that the beneficiary has won aid together with the months and values</option>
                                <option value="relatorio06">List of total payments by region</option>
                                <option value="relatorio07">List of total payments by state</option>
                            </select>
                            <br/>

                            <input class="btn btn-success" type="submit" value="GENERATE REPORT">
                            <hr>
                        </form>
                        
                        <?php
                        if (isset($_POST['relatoriosDisponiveis'])){
                            $relatorioselecionado = $_POST['relatoriosDisponiveis'];
                            
                            if ($relatorioselecionado=="relatorioNulo"){ 
                                echo "Please, select a report from the list above.";
                            }else { 
                                echo "<script>script:window.open('relatorio/".$relatorioselecionado.".php', '_blank');</script>";
                            }                        
                        }
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

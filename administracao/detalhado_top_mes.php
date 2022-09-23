<?php
include("verificar_acesso/login_dono.php");
include("header.php");
?>

<section class="home-section">
    <div class="home-content">
        <i class='bx bx-menu'></i>
    </div>
    <div class="container-fluid" style="width: inherit;">
        <!-- Pode tirar o inherit -->
        <div class="container has-text-centered">
            <div class="column is-4 is-offset-4">
                <h3 class="title has-text-grey">Top mensal</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-sm">
                <!-- Conteúdo -->
                <?php
                $query_controle_venda = mysqli_query($conexao, "SELECT nome_produto, fornecedor, sum(qtd_comprada), sum(total_venda) from controle_venda where month(data_venda) = month(now()) and year(data_venda) = year(now()) group by nome_produto, fornecedor order by qtd_comprada desc");

                if (mysqli_num_rows($query_controle_venda) > 0) { ?>
                    <div class="table-responsive">
                        <table id="top-mes" class="display table" style="width:100%">
                            <thead class="table-dark">
                                <tr>
                                    <th id="tabela-head-white" scope="col">Produto</th>
                                    <th id="tabela-head-white" scope="col">Fornecedor</th>
                                    <th id="tabela-head-white" scope="col">Quantidade comprada</th>
                                    <th id="tabela-head-white" scope="col">Total de vendas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row_controle_venda = mysqli_fetch_assoc($query_controle_venda)) { ?>
                                    <tr>
                                        <th class="table-secondary" scope="row"><?php echo $row_controle_venda['nome_produto']; ?></th>
                                        <td class="table-secondary"><?php echo $row_controle_venda['fornecedor']; ?></td>
                                        <td class="table-secondary"><?php echo $row_controle_venda['sum(qtd_comprada)']; ?></td>
                                        <td class="table-secondary"><?php echo "R$ " . number_format($row_controle_venda['sum(total_venda)'], 2, ",", "."); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } else { ?>
                    <div class='alert alert-danger d-flex align-items-center' role='alert'>
                        <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'>
                            <use xlink:href='#exclamation-triangle-fill' />
                        </svg>
                        <div> Nenhuma venda realizada!</div>
                    </div>
                <?php  } ?>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#top-mes').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json'
            }
        });
    });
</script>
<?php include("footer.php"); ?>
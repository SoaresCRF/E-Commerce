<?php
include("verificar_acesso/login_administracao.php");
include("header.php");
?>

<section class="home-section">
    <div class="home-content">
        <i class='bx bx-menu'></i>
    </div>
    <div class="container-fluid" style="width: inherit;">
        <!-- Pode tirar o inherit -->
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <?php
                if (isset($_SESSION['status_apagado'])) :
                ?>
                    <div class="notification is-success">
                        <p>Exclusão de dado realizada!</p>
                    </div>
                <?php
                endif;
                unset($_SESSION['status_apagado']);
                ?>

                <?php
                if (isset($_SESSION['cod_produto_nao_existe'])) :
                ?>
                    <div class="notification is-info">
                        <p>Código de produto não encontrado. <a href="visualizar_produtos.php">Visualizar produtos cadastrados.</a></p>
                    </div>
                <?php
                endif;
                unset($_SESSION['cod_produto_nao_existe']);
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <!-- Conteúdo -->
                <div class="table-responsive">
                    <table id="visualizar-produtos" class="display table" style="width:100%">
                        <thead class="table-dark">
                            <tr>
                                <th id="tabela-head-white" scope="col">#</th>
                                <th id="tabela-head-white" scope="col">Nome</th>
                                <th id="tabela-head-white" scope="col">Fornecedor</th>
                                <th id="tabela-head-white" scope="col">Custo do produto</th>
                                <th id="tabela-head-white" scope="col">Valor de venda</th>
                                <th id="tabela-head-white" scope="col">Estoque</th>
                                <th id="tabela-head-white" scope="col">Categoria</th>
                                <?php if ($_SESSION["cargo"] == "dono") { ?>
                                    <th id="tabela-head-white" scope="col">&nbsp;</th>
                                    <th id="tabela-head-white" scope="col">&nbsp;</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $sql = "SELECT * FROM produtos order by estoque, nome_produto, categoria, fornecedor";
                            $query_produtos = mysqli_query($conexao, $sql);
                            while ($row_produtos = mysqli_fetch_assoc($query_produtos)) { ?>
                                <tr>
                                    <?php if ($row_produtos["estoque"] <= 10) { ?>
                                        <th class="table-danger" scope="row"><?php echo $row_produtos['cod_produto']; ?></th>
                                        <td class="table-danger"><?php echo $row_produtos['nome_produto']; ?></td>
                                        <td class="table-danger"><?php echo $row_produtos['fornecedor']; ?></td>
                                        <td class="table-danger"><?php echo "R$ " . number_format($row_produtos['custo_produto'], 2, ",", "."); ?></td>
                                        <td class="table-danger"><?php echo "R$ " . number_format($row_produtos['valor_venda'], 2, ",", "."); ?></td>
                                        <td class="table-danger"><?php echo $row_produtos['estoque']; ?></td>
                                        <td class="table-danger"><?php echo $row_produtos['categoria']; ?></td>
                                        <?php if ($_SESSION["cargo"] == "dono") { ?>
                                            <td class="table-danger">
                                                <a title="Deletar" href='bd_administracao/bd_apagar_produto.php?cod_produto=<?php echo $row_produtos['cod_produto']; ?>'><button class='close'><i id="tabela-deletar" style="font-size: 15px;" class="fa-solid fa-x"></i></button></a>
                                            </td>
                                            <td class="table-danger">
                                                <a title="Editar" href='editar_produto.php?cod_produto=<?php echo $row_produtos['cod_produto']; ?>'><button class='close'><i id="tabela-editar" style="font-size: 15px;" class="fa-regular fa-pen-to-square"></i></button></a>
                                            </td>
                                        <?php } ?>
                                    <?php } elseif ($row_produtos["estoque"] <= 30) { ?>
                                        <th class="table-warning" scope="row"><?php echo $row_produtos['cod_produto']; ?></th>
                                        <td class="table-warning"><?php echo $row_produtos['nome_produto']; ?></td>
                                        <td class="table-warning"><?php echo $row_produtos['fornecedor']; ?></td>
                                        <td class="table-warning"><?php echo "R$ " . number_format($row_produtos['custo_produto'], 2, ",", "."); ?></td>
                                        <td class="table-warning"><?php echo "R$ " . number_format($row_produtos['valor_venda'], 2, ",", "."); ?></td>
                                        <td class="table-warning"><?php echo $row_produtos['estoque']; ?></td>
                                        <td class="table-warning"><?php echo $row_produtos['categoria']; ?></td>
                                        <?php if ($_SESSION["cargo"] == "dono") { ?>
                                            <td class="table-warning">
                                                <a title="Deletar" href='bd_administracao/bd_apagar_produto.php?cod_produto=<?php echo $row_produtos['cod_produto']; ?>'><button class='close'><i id="tabela-deletar" style="font-size: 15px;" class="fa-solid fa-x"></i></button></a>
                                            </td>
                                            <td class="table-warning">
                                                <a title="Editar" href='editar_produto.php?cod_produto=<?php echo $row_produtos['cod_produto']; ?>'><button class='close'><i id="tabela-editar" style="font-size: 15px;" class="fa-regular fa-pen-to-square"></i></button></a>
                                            </td>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <th class="table-success" scope="row"><?php echo $row_produtos['cod_produto']; ?></th>
                                        <td class="table-success"><?php echo $row_produtos['nome_produto']; ?></td>
                                        <td class="table-success"><?php echo $row_produtos['fornecedor']; ?></td>
                                        <td class="table-success"><?php echo "R$ " . number_format($row_produtos['custo_produto'], 2, ",", "."); ?></td>
                                        <td class="table-success"><?php echo "R$ " . number_format($row_produtos['valor_venda'], 2, ",", "."); ?></td>
                                        <td class="table-success"><?php echo $row_produtos['estoque']; ?></td>
                                        <td class="table-success"><?php echo $row_produtos['categoria']; ?></td>
                                        <?php if ($_SESSION["cargo"] == "dono") { ?>
                                            <td class="table-success">
                                                <a title="Deletar" href='bd_administracao/bd_apagar_produto.php?cod_produto=<?php echo $row_produtos['cod_produto']; ?>'><button class='close'><i id="tabela-deletar" style="font-size: 15px;" class="fa-solid fa-x"></i></button></a>
                                            </td>
                                            <td class="table-success">
                                                <a title="Editar" href='editar_produto.php?cod_produto=<?php echo $row_produtos['cod_produto']; ?>'><button class='close'><i id="tabela-editar" style="font-size: 15px;" class="fa-regular fa-pen-to-square"></i></button></a>
                                            </td>
                                        <?php } ?>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#visualizar-produtos').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json'
            }
        });
    });
</script>
<?php include("footer.php"); ?>
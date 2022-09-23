<?php
include("verificar_acesso/login_dono.php");
include("header.php");
$cod_produto = filter_input(INPUT_GET, 'cod_produto', FILTER_SANITIZE_NUMBER_INT);

$query_produtos = mysqli_query($conexao, "SELECT * from produtos where cod_produto = '$cod_produto'");
$row_produtos = mysqli_fetch_assoc($query_produtos);
?>

<section class="home-section">
    <div class="home-content">
        <i class='bx bx-menu'></i>
    </div>

    <div class="container-fluid" style="width: inherit;">
        <!-- Pode tirar o inherit -->
        <div class="container has-text-centered">
            <div class="column is-4 is-offset-4">
                <h3 class="title has-text-grey">Editar produto</h3>

                <?php
                if (isset($_SESSION['status_editado'])) :
                ?>
                    <div class="notification is-success">
                        <p>Edição efetuado!</p>
                    </div>
                <?php
                endif;
                unset($_SESSION['status_editado']);
                ?>


                <?php
                if (isset($_SESSION['produto_existe'])) :
                ?>
                    <div class="notification is-info">
                        <p>O produto e fornecedor informado já foram registrados. Informe outro e tente novamente.</p>
                    </div>
                <?php
                endif;
                unset($_SESSION['produto_existe']);
                ?>


                <?php
                if (isset($_SESSION['cod_produto_nao_existe'])) :
                ?>
                    <div class="notification is-info">
                        <p>O código do produto não já existe. Informe outro e tente novamente.</p>
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
                <div class="hero-body">
                    <div class="container has-text-centered">
                        <div class="column is-4 is-offset-4">
                            <div class="box">
                                <form action="bd_administracao/bd_gerente.php" method="POST">
                                    <div class="field">
                                        <div class="control">
                                            <input id="inputDesabilitado" readonly name="cod_produto" type="number" class="input is-large" placeholder="Código produto" value="<?php if (mysqli_num_rows($query_produtos) > 0) {
                                                                                                                                                                                    echo $row_produtos['cod_produto'];
                                                                                                                                                                                } ?>" autofocus required>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <div class="control">
                                            <input id="inputDesabilitado" name="nome_produto" readonly type="text" class="input is-large" placeholder="Nome produto" value="<?php if (mysqli_num_rows($query_produtos) > 0) {
                                                                                                                                                                                echo $row_produtos['nome_produto'];
                                                                                                                                                                            } ?>" required>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <div class="control">
                                            <input id="inputDesabilitado" name="fornecedor" readonly type="text" class="input is-large" placeholder="Fornecedor" value="<?php if (mysqli_num_rows($query_produtos) > 0) {
                                                                                                                                                                            echo $row_produtos['fornecedor'];
                                                                                                                                                                        } ?>" required>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <div class="control">
                                            <input id="animacaoInput" name="custo_produto" type="number" step="0.01" class="input is-large" placeholder="Custo produto" value="<?php if (mysqli_num_rows($query_produtos) > 0) {
                                                                                                                                                                                    echo $row_produtos['custo_produto'];
                                                                                                                                                                                } ?>" required>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <div class="control">
                                            <input id="animacaoInput" name="valor_venda" type="number" step="0.01" class="input is-large" placeholder="Valor venda" value="<?php if (mysqli_num_rows($query_produtos) > 0) {
                                                                                                                                                                                echo $row_produtos['valor_venda'];
                                                                                                                                                                            } ?>" required>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <div class="control">
                                            <input id="animacaoInput" name="estoque" type="number" class="input is-large" placeholder="Adicionar ao estoque" value="" required>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <div class="control">
                                            <select name="categoria" id="animacaoInput" style="max-width: 100%; width: 100%; height: 47.25px;" required>
                                                <option value="Alimento" selected>Alimento</option>
                                                <option value="Bebida">Bebida</option>
                                                <option value="Celular">Celular</option>
                                                <option value="Hardware">Hardware</option>
                                                <option value="Jogo">Jogo</option>
                                            </select>
                                        </div>
                                    </div>

                                    <button id="butaoforms" type="submit" name="editarProduto" value="editarProduto" class="button is-block is-link is-large is-fullwidth">Editar</button>
                                    <p style="margin-top: 10px; text-decoration: underline;"><a href="visualizar_produtos.php">Visualizar produtos cadastrados</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include("footer.php"); ?>
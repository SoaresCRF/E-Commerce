<?php 
include ("verificar_acesso/login_dono.php");
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
                <h3 class="title has-text-grey">Cadastrar produto</h3>

                <?php
                if (isset($_SESSION['status_cadastro'])) :
                ?>
                    <div class="notification is-success">
                        <p>Cadastro efetuado!</p>
                    </div>
                <?php
                endif;
                unset($_SESSION['status_cadastro']);
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
                if (isset($_SESSION['cod_produto_existe'])) :
                ?>
                    <div class="notification is-info">
                        <p>O código do produto já existe. Informe outro e tente novamente.</p>
                    </div>
                <?php
                endif;
                unset($_SESSION['cod_produto_existe']);
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
                                            <input id="animacaoInput" name="cod_produto" type="number" class="input is-large" placeholder="Código produto" autofocus required>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <div class="control">
                                            <input id="animacaoInput" name="nome_produto" type="text" class="input is-large" placeholder="Nome produto" required>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <div class="control">
                                            <input id="animacaoInput" name="fornecedor" type="text" class="input is-large" placeholder="Fornecedor" required>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <div class="control">
                                            <input id="animacaoInput" name="custo_produto" type="number" step="0.01" class="input is-large" placeholder="Custo produto" required>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <div class="control">
                                            <input id="animacaoInput" name="estoque" type="number" class="input is-large" placeholder="Estoque" required>
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

                                    <button id="butaoforms" name="cadastrarProduto" value="cadastrarProduto" type="submit" class="button is-block is-link is-large is-fullwidth">Cadastrar</button>

                                    <p style="margin-top: 10px;"><a style="text-decoration: none; color: #11101D;" href="visualizar_produtos.php">Visualizar produtos cadastrados</a></p>
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
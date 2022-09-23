<?php include("header.php"); ?>

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
                        <p>Código de produto não encontrado. <a href="listar_produtos.php">Visualizar produtos cadastrados.</a></p>
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



            </div>
        </div>
    </div>
</section>

<?php include("footer.php"); ?>
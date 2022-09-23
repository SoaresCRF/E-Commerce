<?php include("header.php"); ?>


<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Celulares</span></h2>
        <?php
        if (isset($_SESSION['item_adicionado'])) :
        ?>
            <p style="color: green; font-size: 22px;">Item adicionado ao <a style="font-weight: bold; color: green;" href="carrinho.php">carrinho!</a></p>
        <?php
        endif;
        unset($_SESSION['item_adicionado']);
        ?>


        <?php
        if (isset($_SESSION['realize_login'])) :
        ?>
            <p style="color: red; font-size: 22px;">Realize login para poder adicionar ao carrinho!</p>
        <?php
        endif;
        unset($_SESSION['realize_login']);
        ?>
    </div>
    <div class="row px-xl-5 pb-3">
        <?php
        $sql = "SELECT * FROM produtos
                where categoria = 'Celular' 
                order by nome_produto, fornecedor";
        $query = mysqli_query($conexao, $sql);
        while ($row_produto = mysqli_fetch_assoc($query)) {
            if ($row_produto['estoque'] != 0) { ?>
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100" src="../img/produto_ficticio.jpg" alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3"><?php echo $row_produto['nome_produto']; ?></h6>
                            <div class="d-flex justify-content-center">
                                <h6>R$ <?php echo number_format($row_produto['valor_venda'], 2, ',', '.'); ?></h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <?php if ($_SESSION['cargo'] != "cliente" or $row_produto['estoque'] < 1) { ?>
                                <?php if ($_SESSION['cargo'] != "cliente") { ?>
                                    <a href="#" onclick="realize_login_carrinho();" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add ao carrinho</a>
                                <?php } else { ?>
                                    <a href="#" onclick="estoque_esgotado();" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add ao carrinho</a>
                                <?php } ?>
                            <?php  } else { ?>
                                <a href="bd_cliente/bd_carrinho.php?cod_produto=<?php echo $row_produto['cod_produto']; ?>" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add ao carrinho</a>
                            <?php } ?>
                            <span class="btn-sm text-dark p-0">Estoque: <?php echo $row_produto['estoque']; ?></span>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</div>


<?php include("footer.php"); ?>
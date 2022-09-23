<?php
include("../_conect/conexao.php");
include("verificar_acesso/verifica_login_cliente_limitado.php");

if (isset($_SESSION['cpf'])) {
    $cpf = $_SESSION['cpf'];

    $sql = "SELECT * from clientes_cadastrados where cpf = '$cpf'";
    $query_clientes_cadastrados = mysqli_query($conexao, $sql);
    $row_clientes_cadastrados = mysqli_fetch_assoc($query_clientes_cadastrados);
} else {
    $cpf = 0;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>E Commerce - Checkout</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../img/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/icons/favicon-16x16.png">
    <link rel="manifest" href="../img/icons/site.webmanifest">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Css -->
    <link rel="stylesheet" href="../css/style.css">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/loja_cliente.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Commerce</h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
            </div>
            <?php if (isset($_SESSION['cpf'])) {
                $cpf = $_SESSION['cpf'];
                $query_carrinho = mysqli_query($conexao, "SELECT *, count(cpf) FROM carrinho where cpf = $cpf");
                if (mysqli_num_rows($query_carrinho) > 0) {
                    $row_carrinho = mysqli_fetch_assoc($query_carrinho); ?>
                    <div class="col-lg-3 col-6 text-right">
                        <a href="carrinho.php" class="btn border">
                            <i class="fas fa-shopping-cart text-primary"></i>
                            <span class="badge"> <?php echo $row_carrinho['count(cpf)']; ?></span>
                        <?php } else { ?>
                            <span class="badge">0</span>
                        <?php } ?>
                        </a>
                    </div>
                <?php } ?>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Categorias</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                        <a href="todos_produtos.php" class="nav-item nav-link">Todos produtos</a>
                        <a href="alimento.php" class="nav-item nav-link">Alimentos</a>
                        <a href="bebida.php" class="nav-item nav-link">Bebidas</a>
                        <a href="celular.php" class="nav-item nav-link">Celulares</a>
                        <a href="hardware.php" class="nav-item nav-link">Hardware</a>
                        <a href="jogo.php" class="nav-item nav-link">Jogos</a>
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Commerce</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="todos_produtos.php" class="nav-item nav-link">Home</a>
                            <?php if ($_SESSION['cargo'] == "cliente") { ?>
                                <a href="carrinho.php" class="nav-item nav-link">Carrinho</a>
                                <a href="checkout.php" class="nav-item nav-link active">Checkout</a>
                                <a href="pedidos_concluidos.php" class="nav-item nav-link">Meus pedidos</a>
                            <?php } ?>
                        </div>
                        <?php if ($_SESSION['cargo'] != "cliente") { ?>
                            <div class="navbar-nav ml-auto py-0">
                                <a href="login_cliente.php" class="nav-item nav-link">Login</a>
                                <a href="registrar_cliente.php" class="nav-item nav-link">Registrar</a>
                            </div>
                        <?php } else { ?>
                            <div class="navbar-nav ml-auto py-0">
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"> <?php echo $_SESSION['username']; ?></a>
                                    <div class="dropdown-menu rounded-0 m-0">
                                        <a href="carrinho.php" class="dropdown-item">Carrinho</a>
                                        <a href="checkout.php" class="dropdown-item">Checkout</a>
                                        <a href="pedidos_concluidos.php" class="dropdown-item">Meus pedidos</a>
                                        <a href="bd_cliente/logout_cliente.php" class="dropdown-item">Sair</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Checkout</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="todos_produtos.php">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Checkout</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="text-center mb-4">
        <?php
        if (isset($_SESSION['nenhuma_conta_logada'])) :
        ?>
            <p style="color: red; font-size: 20px;">Nenhuma conta logada!</p>
        <?php
        endif;
        unset($_SESSION['nenhuma_conta_logada']);
        ?>


        <?php
        if (isset($_SESSION['nenhum_item_no_carrinho'])) :
        ?>
            <p style="color: red; font-size: 20px;">Nenhum item no carrinho!</p>
        <?php
        endif;
        unset($_SESSION['nenhum_item_no_carrinho']);
        ?>


        <?php
        if (isset($_SESSION['compra_realizada'])) :
        ?>
            <p style="color: green; font-size: 20px; font-weight: bold;">Compra realizada com sucesso!</p>
            <p><a href="pedidos_concluidos.php" style="color: green; font-size: 20px; ">Visualizar meus pedidos</a></p>
        <?php
        endif;
        unset($_SESSION['compra_realizada']);
        ?>


        <?php
        if (isset($_SESSION['dados_atualizados'])) :
        ?>
            <div class="text-center mb-4">
                <p style="color: green; font-size: 22px;">Dados atualizados!!!</p>
            </div>
        <?php
        endif;
        unset($_SESSION['dados_atualizados']);
        ?>


        <?php
        if (isset($_SESSION['preencha_campo'])) :
        ?>
            <div class="text-center mb-4">
                <p style="color: red; font-size: 22px;">Preencha todos os campos.</p>
            </div>
        <?php
        endif;
        unset($_SESSION['preencha_campo']);
        ?>


        <?php
        if (isset($_SESSION['email_invalido'])) :
        ?>
            <div class="text-center mb-4">
                <p style="color: red; font-size: 22px;">Informe e-mail válido</p>
            </div>
        <?php
        endif;
        unset($_SESSION['email_invalido']);
        ?>


        <?php
        if (isset($_SESSION['cep_invalido'])) :
        ?>
            <div class="text-center mb-4">
                <p style="color: red; font-size: 22px;">CEP inválido</p>
            </div>
        <?php
        endif;
        unset($_SESSION['cep_invalido']);
        ?>


        <?php
        if (isset($_SESSION['ddd_invalido'])) :
        ?>
            <div class="text-center mb-4">
                <p style="color: red; font-size: 22px;">DDD não encontrado</p>
            </div>
        <?php
        endif;
        unset($_SESSION['ddd_invalido']);
        ?>


        <?php
        if (isset($_SESSION['celular_invalido'])) :
        ?>
            <div class="text-center mb-4">
                <p style="color: red; font-size: 22px;">Celular fora do padrão</p>
            </div>
        <?php
        endif;
        unset($_SESSION['celular_invalido']);
        ?>


        <?php
        if (isset($_SESSION['numero_casa_invalido'])) :
        ?>
            <div class="text-center mb-4">
                <p style="color: red; font-size: 22px;">Somente números</p>
            </div>
        <?php
        endif;
        unset($_SESSION['numero_casa_invalido']);
        ?>


        <?php
        if (isset($_SESSION['estado_invalido'])) :
        ?>
            <div class="text-center mb-4">
                <p style="color: red; font-size: 22px;">Estado inválido</p>
            </div>
        <?php
        endif;
        unset($_SESSION['estado_invalido']);
        ?>


        <?php
        if (isset($_SESSION['cidade_invalido'])) :
        ?>
            <div class="text-center mb-4">
                <p style="color: red; font-size: 22px;">Cidade inválida</p>
            </div>
        <?php
        endif;
        unset($_SESSION['cidade_invalido']);
        ?>


        <?php
        if (isset($_SESSION['bairro_invalido'])) :
        ?>
            <div class="text-center mb-4">
                <p style="color: red; font-size: 22px;">Bairro inválido</p>
            </div>
        <?php
        endif;
        unset($_SESSION['bairro_invalido']);
        ?>


        <?php
        if (isset($_SESSION['rua_invalido'])) :
        ?>
            <div class="text-center mb-4">
                <p style="color: red; font-size: 22px;">Rua inválida</p>
            </div>
        <?php
        endif;
        unset($_SESSION['rua_invalido']);
        ?>


        <?php
        if (isset($_SESSION['email_existe'])) :
        ?>
            <div class="text-center mb-4">
                <p style="color: red; font-size: 22px;">E-mail informado já cadastrado. Informe outro</p>
            </div>
        <?php
        endif;
        unset($_SESSION['email_existe']);
        ?>
    </div>

    <!-- Checkout Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Endereço de entrega</h4>
                    <form action="bd_cliente/bd_atualizar_dados.php" method="post">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>E-mail</label>
                                <input class="form-control" type="text" name="email" value="<?php if (mysqli_num_rows($query_clientes_cadastrados) > 0) {
                                                                                                echo $row_clientes_cadastrados['email'];
                                                                                            } ?>" placeholder="example@email.com">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Celular</label>
                                <input class="form-control" id="phone_with_ddd" type="text" name="celular" value="<?php if (mysqli_num_rows($query_clientes_cadastrados) > 0) {
                                                                                                                        echo $row_clientes_cadastrados['celular'];
                                                                                                                    } ?>" placeholder="(DD) 9xxxx-xxxx">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>CEP</label>
                                <input class="form-control" onblur="pesquisacep(this.value);" id="cep" name="cep" value="<?php if (mysqli_num_rows($query_clientes_cadastrados) > 0) {
                                                                                                                                echo $row_clientes_cadastrados['cep'];
                                                                                                                            } ?>" type="text" placeholder="XXXXX-XXX">
                                <a href="#" onclick="javascript:abrirEmPopup('https://buscacepinter.correios.com.br/app/localidade_logradouro/index.php', 1025, 550);">Não sei meu CEP</a>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Estado</label>
                                <input class="form-control" id="uf" readonly required name="estado" value="<?php if (mysqli_num_rows($query_clientes_cadastrados) > 0) {
                                                                                                                echo $row_clientes_cadastrados['estado'];
                                                                                                            } ?>" type="text" placeholder="Estado">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Cidade</label>
                                <input class="form-control" id="cidade" readonly required name="cidade" value="<?php if (mysqli_num_rows($query_clientes_cadastrados) > 0) {
                                                                                                                    echo $row_clientes_cadastrados['cidade'];
                                                                                                                } ?>" type="text" placeholder="Cidade">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Bairro</label>
                                <input class="form-control" id="bairro" readonly required name="bairro" value="<?php if (mysqli_num_rows($query_clientes_cadastrados) > 0) {
                                                                                                                    echo $row_clientes_cadastrados['bairro'];
                                                                                                                } ?>" type="text" placeholder="Bairro">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Rua</label>
                                <input class="form-control" id="rua" readonly required name="rua" value="<?php if (mysqli_num_rows($query_clientes_cadastrados) > 0) {
                                                                                                                echo $row_clientes_cadastrados['rua'];
                                                                                                            } ?>" type="text" placeholder="Rua">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Número casa</label>
                                <input class="form-control" pattern="[0-9]+" title="Somente números" id="somenteNumero" name="numero_casa" value="<?php if (mysqli_num_rows($query_clientes_cadastrados) > 0) {
                                                                                                                                                        echo $row_clientes_cadastrados['numero_casa'];
                                                                                                                                                    } ?>" type="text" placeholder="123">
                            </div>
                            <div class="col-md-3 form-group">
                                <div class="custom-control custom-checkbox">
                                    <button type="submit" class="btn btn-block btn-primary my-3 py-3">Confirma dados</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Total de pedidos</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Produtos</h5>
                        <?php
                        $query_carrinho = mysqli_query($conexao, "SELECT * from carrinho where cpf = '$cpf'");
                        $total = 0;
                        while ($row_carrinho = mysqli_fetch_assoc($query_carrinho)) {
                            $cod_produto = $row_carrinho['cod_produto'];
                            $query_produtos = mysqli_query($conexao, "SELECT * from produtos where cod_produto = '$cod_produto'");
                            $row_produtos = mysqli_fetch_assoc($query_produtos);
                            $total += $row_carrinho['quantidade'] * $row_carrinho['total'];
                        ?>
                            <div class="d-flex justify-content-between">
                                <p><?php if (mysqli_num_rows($query_produtos) > 0) {
                                        echo $row_produtos['nome_produto'];
                                    } ?></p>
                                <p>R$ <?php if (mysqli_num_rows($query_produtos) > 0) {
                                            echo number_format($row_carrinho['quantidade'] * $row_carrinho['total'], 2, ',', '.');
                                        } ?></p>
                            </div>
                        <?php } ?>
                        <hr class="mt-0">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <?php if ($total > 0) { ?>
                                <h6 class="font-weight-medium">R$ <?php echo number_format($total, 2, ',', '.'); ?></h6>
                            <?php  } else { ?>
                                <h6 class="font-weight-medium">R$ 0,00</h6>
                            <?php } ?>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Frete</h6>
                            <?php if ($total > 0) { ?>
                                <h6 class="font-weight-medium">R$ 30,00</h6>
                            <?php } else { ?>
                                <h6 class="font-weight-medium">R$ 0,00</h6>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <?php if ($total > 0) { ?>
                                <h5 class="font-weight-bold">R$ <?php echo number_format($total + 30, 2, ',', '.'); ?></h5>
                            <?php  } else { ?>
                                <h5 class="font-weight-bold">R$ 0,00</h5>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <form action="bd_cliente/bd_finalizar_compra.php" method="post">
                    <div class="card border-secondary mb-5">
                        <div class="card-footer border-secondary bg-transparent">
                            <button class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Concluir compra</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Checkout End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-dark mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <a href="" class="text-decoration-none">
                    <h1 class="mb-4 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border border-white px-3 mr-1">E</span>Commerce</h1>
                </a>
                <p>Dolore erat dolor sit lorem vero amet. Sed sit lorem magna, ipsum no sit erat lorem et magna ipsum dolore amet erat.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Rua, Feira de Santana, BR</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>(75) 93456-7890</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <div class="d-flex flex-column justify-content-start">
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Links Rápidos</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="todos_produtos.php"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-dark mb-2" href="#categorias"><i class="fa fa-angle-right mr-2"></i>Shop</a>
                            <a class="text-dark" href="#"><i class="fa fa-angle-right mr-2"></i>Lorem ipsum</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top border-light mx-xl-5 py-4">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-dark">
                    &copy; <a class="text-dark font-weight-semi-bold" href="#">E Commerce</a>. All Rights Reserved. Designed
                    by
                    <a class="text-dark font-weight-semi-bold" href="https://htmlcodex.com">HTML Codex</a><br>
                    Distributed By <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                </p>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/loja_cliente.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="../js/abrirEmPopup.js"></script>
    <script src="../js/via_vep.js"></script>
    <script src="../js/mask.js"></script>
</body>

</html>
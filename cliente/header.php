<?php
include("../_conect/conexao.php");
include("verificar_acesso/verifica_login_cliente.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>E Commerce</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

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
                $sql = "SELECT *, count(cpf) FROM carrinho
                        where cpf = $cpf";
                $query_carrinho = mysqli_query($conexao, $sql);
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
    <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
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
                            <a href="todos_produtos.php" class="nav-item nav-link active">Home</a>
                            <a href="#categorias" class="nav-item nav-link">Shop</a>
                            <?php if ($_SESSION['cargo'] == "cliente") { ?>
                                <a href="carrinho.php" class="nav-item nav-link">Carrinho</a>
                                <a href="checkout.php" class="nav-item nav-link">Checkout</a>
                                <a href="pedidos_concluidos.php" class="nav-item nav-link">Meus pedidos</a>
                            <?php } ?>
                        </div>
                        <?php if ($_SESSION['cargo'] != "cliente") { ?>
                            <?php
                            if (isset($_SESSION['cliente_cadastrado'])) :
                            ?>
                                <div class="text-center mb-4">
                                    <p style="color: green; font-size: 20px;">Cadastro efetuado com sucesso! <a style="color: green; font-weight: bold;" href="login_cliente.php">Clique aqui</a></p>
                                </div>
                            <?php
                            endif;
                            unset($_SESSION['cliente_cadastrado']);
                            ?>
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
                <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        $sql = "SELECT cod_produto, nome_produto, sum(qtd_comprada) FROM controle_venda
                                group by nome_produto 
                                order by sum(qtd_comprada) desc limit 5";
                        $query_controle_venda = mysqli_query($conexao, $sql);
                        $cont = 0;
                        while ($row_controle_venda = mysqli_fetch_assoc($query_controle_venda)) {
                            if ($cont == 0) {
                                $cont++; ?>
                                <div class="carousel-item active" style="height: 410px;">
                                    <img class="img-fluid" src="../img/produto_ficticio.jpg" alt="Image">
                                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                        <div class="p-3" style="max-width: 700px;">
                                            <h4 class="text-light text-uppercase font-weight-medium mb-3">Destaques</h4>
                                            <h3 class="display-4 text-white font-weight-semi-bold mb-4"><?php echo $row_controle_venda['nome_produto']; ?></h3>
                                            <a href="bd_cliente/bd_carrinho.php?cod_produto=<?php echo $row_controle_venda['cod_produto']; ?>" class="btn btn-light py-2 px-3">Compre agora</a>
                                        </div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="carousel-item" style="height: 410px;">
                                    <img class="img-fluid" src="../img/produto_ficticio.jpg" alt="Image">
                                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                        <div class="p-3" style="max-width: 700px;">
                                            <h4 class="text-light text-uppercase font-weight-medium mb-3">Destaques</h4>
                                            <h3 class="display-4 text-white font-weight-semi-bold mb-4"><?php echo $row_controle_venda['nome_produto']; ?></h3>
                                            <a href="bd_cliente/bd_carrinho.php?cod_produto=<?php echo $row_controle_venda['cod_produto']; ?>" class="btn btn-light py-2 px-3">Compre agora</a>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-prev-icon mb-n2"></span>
                        </div>
                    </a>
                    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-next-icon mb-n2"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Categories Start -->
    <div class="container-fluid pt-5" id="categorias">
        <div class="row px-xl-5 pb-3">
            <?php
            $sql = "SELECT categoria, count(categoria) FROM produtos
                    group by categoria";
            $query_produtos = mysqli_query($conexao, $sql);
            while ($row_produtos = mysqli_fetch_assoc($query_produtos)) { ?>
                <div class="col-lg-4 col-md-6 pb-1">
                    <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                        <p class="text-right"><?php echo $row_produtos['count(categoria)']; ?> Produtos</p>
                        <a href="<?php echo $row_produtos['categoria']; ?>.php" class="cat-img position-relative overflow-hidden mb-3">
                            <img class="img-fluid" src="../img/produto_ficticio.jpg" alt="">
                        </a>
                        <h5 class="font-weight-semi-bold m-0"><?php echo $row_produtos['categoria']; ?></h5>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <!-- Categories End -->
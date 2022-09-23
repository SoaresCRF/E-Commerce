<?php
include("../_conect/conexao.php");
include("verificar_acesso/verifica_login_cliente_limitado.php");

if (isset($_SESSION['cpf'])) {
    $cpf = $_SESSION['cpf'];
} else {
    $cpf = 0;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>E Commerce - Meus pedidos</title>
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

    <!-- Data table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
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
                                <a href="checkout.php" class="nav-item nav-link">Checkout</a>
                                <a href="pedidos_concluidos.php" class="nav-item nav-link active">Meus pedidos</a>
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
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Meus pedidos</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="todos_produtos.php">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Meus pedidos</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table id="carrinho" class="table display table-bordered text-center mb-0" style="width:100%">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Produtos</th>
                            <th>Quantidade comprada</th>
                            <th>Total</th>
                            <th>Aquisição</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php
                        $sql = "SELECT * from pedidos_concluidos 
                                where cpf_cliente = '$cpf'
                                order by total_comprado desc, qtd_comprada desc, nome_produto, fornecedor";
                        $query_pedidos_concluidos = mysqli_query($conexao, $sql);
                        while ($row_pedidos_concluidos = mysqli_fetch_assoc($query_pedidos_concluidos)) { ?>
                            <tr>
                                <td class="align-middle"><img src="img/product-1.jpg" alt="" style="width: 50px;"> <?php if (mysqli_num_rows($query_pedidos_concluidos) > 0) {
                                                                                                                        echo $row_pedidos_concluidos['nome_produto'];
                                                                                                                    } ?></td>

                                <td class="align-middle"><?php echo $row_pedidos_concluidos['qtd_comprada']; ?> </td>


                                <td class="align-middle">R$ <?php if (mysqli_num_rows($query_pedidos_concluidos) > 0) {
                                                                echo number_format($row_pedidos_concluidos['total_comprado'], 2, ',', '.');
                                                            } ?></td>

                                <td class="align-middle"><?php if (mysqli_num_rows($query_pedidos_concluidos) > 0) {
                                                                echo  date('d-m-Y', strtotime($row_pedidos_concluidos['data_compra']));
                                                            } ?></td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Meus pedidos resumo</h4>
                    </div>
                    <?php
                    $sql = "SELECT sum(total_comprado), sum(qtd_comprada) from pedidos_concluidos where cpf_cliente = '$cpf'";
                    $query = mysqli_query($conexao, $sql);
                    $row_pedidos_concluidos = mysqli_fetch_assoc($query);
                    ?>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Itens comprados</h6>
                            <h6 class="font-weight-medium"><?php echo $row_pedidos_concluidos['sum(qtd_comprada)']; ?> Itens</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total gasto</h5>
                            <h5 class="font-weight-bold">R$ <?php echo number_format($row_pedidos_concluidos['sum(total_comprado)'], 2, ',', '.'); ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->


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


    <!-- Data table scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#carrinho').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json'
                }
            });
        });
    </script>
</body>

</html>
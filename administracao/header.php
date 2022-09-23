<?php
include("../_conect/conexao.php");

?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr" style="background-color: #E4E9F7;">

<head>
    <meta charset="UTF-8">
    <title> Administração </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Box icons -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- Font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Meu css -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- Sidebar css -->
    <link rel="stylesheet" href="../css/sidebar.css">
    <!-- Bulma css -->
    <link rel="stylesheet" href="../css/bulma.min.css" />
    <!-- Data table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body>
    <div class="sidebar close">
        <div class="logo-details">
            <i class='bx bxl-c-plus-plus'></i>
            <span class="logo_name">E-Commerce</span>
        </div>
        <ul class="nav-links">
            <!-- <li>
                <a href="#">
                    <i class='bx bx-grid-alt'></i>
                    <span class="link_name">Dashboard</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Category</a></li>
                </ul>
            </li> -->
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class='bx bx-collection'></i>
                        <span class="link_name">Produto</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Produto</a></li>
                    <li><a href="visualizar_produtos.php">Visualizar</a></li>
                    <?php if ($_SESSION["cargo"] == "dono") { ?>
                        <li><a href="cadastrar_produto.php">Cadastrar</a></li>
                    <?php } ?>
                </ul>
            </li>

            <?php if ($_SESSION["cargo"] == "dono") { ?>
                <li>
                    <div class="iocn-link">
                        <a href="#">
                            <i class='bi bi-person'></i>
                            <span class="link_name">Funcionários</span>
                        </a>
                        <i class='bx bxs-chevron-down arrow'></i>
                    </div>
                    <ul class="sub-menu">
                        <li><a class="link_name" href="#">Funcionários</a></li>
                        <li><a href="visualizar_funcionarios.php">Visualizar</a></li>
                        <li><a href="cadastrar_funcionario.php">Cadastrar</a></li>
                    </ul>
                </li>
            <?php } ?>
            <?php if ($_SESSION["cargo"] == "dono") { ?>
                <li>
                    <div class="iocn-link">
                        <a href="#">
                            <i class='bi bi-lightning'></i>
                            <span class="link_name">Visão rápida</span>
                        </a>
                        <i class='bx bxs-chevron-down arrow'></i>
                    </div>
                    <ul class="sub-menu">
                        <li><a class="link_name" href="#">Visão rápida</a></li>
                        <li><a href="fast_top_dia.php">Top do dia</a></li>
                        <li><a href="fast_top_mes.php">Top do mês</a></li>
                        <li><a href="fast_top_geral.php">Top geral</a></li>
                    </ul>
                </li>
            <?php } ?>
            <?php if ($_SESSION["cargo"] == "dono") { ?>
                <li>
                    <div class="iocn-link">
                        <a href="#">
                            <i class='bi bi-flag'></i>
                            <span class="link_name">Relatório</span>
                        </a>
                        <i class='bx bxs-chevron-down arrow'></i>
                    </div>
                    <ul class="sub-menu">
                        <li><a class="link_name" href="#">Relatório</a></li>
                        <li><a href="detalhado_top_dia.php">Top do dia</a></li>
                        <li><a href="detalhado_top_mes.php">Top do mês</a></li>
                        <li><a href="detalhado_top_geral.php">Top geral</a></li>
                    </ul>
                </li>
            <?php } ?>
            <?php if ($_SESSION["cargo"] == "dono") { ?>
                <li>
                    <div class="iocn-link">
                        <a href="#">
                            <i class='bi bi-flag'></i>
                            <span class="link_name">Clientes</span>
                        </a>
                        <i class='bx bxs-chevron-down arrow'></i>
                    </div>
                    <ul class="sub-menu">
                        <li><a class="link_name" href="#">Clientes</a></li>
                        <li><a href="cliente_estado.php">Por estado</a></li>
                        <li><a href="cliente_idade.php">Por idade</a></li>
                    </ul>
                </li>
            <?php } ?>

            <!-- <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class='bx bx-book-alt'></i>
                        <span class="link_name">Posts</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Posts</a></li>
                    <li><a href="#">Web Design</a></li>
                    <li><a href="#">Login Form</a></li>
                    <li><a href="#">Card Design</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="link_name">Analytics</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Analytics</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-line-chart'></i>
                    <span class="link_name">Chart</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Chart</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class='bx bx-plug'></i>
                        <span class="link_name">Plugins</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Plugins</a></li>
                    <li><a href="#">UI Face</a></li>
                    <li><a href="#">Pigments</a></li>
                    <li><a href="#">Box Icons</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-compass'></i>
                    <span class="link_name">Explore</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Explore</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-history'></i>
                    <span class="link_name">History</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">History</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-cog'></i>
                    <span class="link_name">Setting</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Setting</a></li>
                </ul>
            </li> -->
            <li>

                <div class="profile-details">
                    <div class="profile-content">
                        <!--<img src="image/profile.jpg" alt="profileImg">-->
                    </div>
                    <div class="name-job">
                        <?php if ($_SESSION["cargo"] == "dono") { ?>
                            <div class="profile_name">Dono</div>
                        <?php } else { ?>
                            <div class="profile_name">Gerente</div>
                        <?php } ?>
                    </div>
                    <a href="../logout.php">
                        <i title="Sair" class='bx bx-log-out'></i>
                    </a>
                </div>
            </li>
        </ul>
    </div>
<?php
include("../verificar_acesso/login_dono.php");
include("../../_conect/conexao.php");

$cod_produto = filter_input(INPUT_GET, "cod_produto", FILTER_SANITIZE_NUMBER_INT);

// Consulta se o código do produto existe
$sql = "SELECT count(*) as total from produtos where cod_produto = '$cod_produto'";
$query_produtos = mysqli_query($conexao, $sql);
$row_produtos = mysqli_fetch_assoc($query_produtos);
if ($row_produtos['total'] == 0) {
    $_SESSION['cod_produto_nao_existe'] = true;
    header('Location: ../visualizar_produtos.php');
    exit;
}

// Deleta o produto
$sql = "DELETE from produtos where cod_produto = '$cod_produto';";
if (mysqli_query($conexao, $sql) === TRUE) {
    $_SESSION['status_apagado'] = true;
}


mysqli_close($conexao);
header('Location: ../visualizar_produtos.php');
exit;

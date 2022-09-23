<?php
include("../verificar_acesso/verifica_login_cliente.php");
include("../../_conect/conexao.php");

$cod_produto = mysqli_real_escape_string($conexao, trim($_POST['cod_produto']));
$quantidade = mysqli_real_escape_string($conexao, trim($_POST['quantidade']));
$cpf = $_SESSION['cpf'];

// Consulta o estoque
$sql = "SELECT estoque FROM produtos where cod_produto = '$cod_produto'";
$query = mysqli_query($conexao, $sql);
$row_produtos = mysqli_fetch_assoc($query);

// Se o estoque for maior ou igual a quantidade pedida e a quantidade pedida for maior do que zero realiza a alteração da quantidade 
if ($row_produtos['estoque'] >= $quantidade and $quantidade >= 1) {
    mysqli_query($conexao, "SET sql_safe_updates=0");
    $sql = "UPDATE carrinho set quantidade = $quantidade where cod_produto = '$cod_produto' and cpf = '$cpf'";
    mysqli_query($conexao, $sql);
    mysqli_query($conexao, "SET sql_safe_updates=1");
}

mysqli_close($conexao);
header("Location: ../carrinho.php");
exit;

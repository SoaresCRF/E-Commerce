<?php
include("../verificar_acesso/verifica_login_cliente.php");
include("../../_conect/conexao.php");


$cod_produto = mysqli_real_escape_string($conexao, trim($_POST['cod_produto']));
$deletar_tudo = mysqli_real_escape_string($conexao, trim($_POST['deletar_tudo']));
$cpf = $_SESSION['cpf'];

if (isset($_POST["deletar_tudo"]) == "deletar_tudo") {
    mysqli_query($conexao, "SET sql_safe_updates=0");
    $sql = "DELETE from carrinho where cpf = '$cpf'";
    mysqli_query($conexao, $sql);
    mysqli_query($conexao, "SET sql_safe_updates=1");
} else {
    $sql = "DELETE from carrinho where cod_produto = '$cod_produto' and cpf = '$cpf'";
    mysqli_query($conexao, $sql);
}

mysqli_close($conexao);
header("Location: ../carrinho.php");
exit;

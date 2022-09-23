<?php
include("../verificar_acesso/verifica_login_cliente.php");
include("../../_conect/conexao.php");


if ($_SESSION['cargo'] != "cliente") {
    $_SESSION['realize_login'] = true;
    header("Location: " . $_SERVER['HTTP_REFERER'] . "");
    exit;
}


$cod_produto = mysqli_real_escape_string($conexao, trim($_GET['cod_produto']));
$quantidade = 1;
$cpf = $_SESSION['cpf'];

// Consulta a quantidade de ocorrência do CPF e a quantidade de produtos no carrinho
$query_carrinho = mysqli_query($conexao, "SELECT count(cpf), quantidade FROM carrinho where cpf = '$cpf' and  cod_produto = '$cod_produto'");
$row_carrinho = mysqli_fetch_assoc($query_carrinho);

// Consulta o estoque e valor de venda
$query_produtos = mysqli_query($conexao, "SELECT estoque, valor_venda FROM produtos where cod_produto = '$cod_produto'");
$row_produtos = mysqli_fetch_assoc($query_produtos);
$valor_venda = $row_produtos['valor_venda'];

if ($row_produtos['estoque'] > 0) {
    if ($row_carrinho['count(cpf)'] == 0) {
        mysqli_query($conexao, "INSERT INTO carrinho (cpf, cod_produto, quantidade, total) VALUES ('$cpf','$cod_produto', '$quantidade', '$valor_venda')");
        $_SESSION['item_adicionado'] = true;
    } else {
        if ($row_produtos['estoque'] >= $quantidade += $row_carrinho['quantidade']) {
            mysqli_query($conexao, "SET sql_safe_updates=0");
            mysqli_query($conexao, "UPDATE carrinho set quantidade = $quantidade where cod_produto = '$cod_produto' and cpf = '$cpf'");
            mysqli_query($conexao, "SET sql_safe_updates=1");
            $_SESSION['item_adicionado'] = true;
        }
        else {
            $_SESSION['ultrapassou_estoque_disponivel'] = true;
        }
    }
}
else {
    $_SESSION['estoque_esgotado'] = true;
}



mysqli_close($conexao);
// Volta para a página anterior
header("Location: " . $_SERVER['HTTP_REFERER'] . "");
exit;

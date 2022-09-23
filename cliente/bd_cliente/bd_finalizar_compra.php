<?php
include("../verificar_acesso/verifica_login_cliente.php");
include("../../_conect/conexao.php");


// Verifica se a sessão ativa é de cliente
if ($_SESSION['cargo'] != "cliente") {
    $_SESSION['nenhuma_conta_logada'] = true;
    header("Location: ../carrinho.php");
    exit;
}

$cpf = $_SESSION['cpf'];
// Consulta o carrinho de compra do cliente logado
$sql = "SELECT * from carrinho where cpf = '$cpf'";
$query_carrinho = mysqli_query($conexao, $sql);
if (mysqli_num_rows($query_carrinho) > 0) {
    mysqli_query($conexao, "SET sql_safe_updates=0");

    while ($row_carrinho = mysqli_fetch_assoc($query_carrinho)) {
        // Salva o código do produto e a quantidade que está no carrinho
        $cod_produto = $row_carrinho['cod_produto'];
        $qtd_comprada = $row_carrinho['quantidade'];

        // Salva as informações do produto que está no carrinho
        $sql = "SELECT * from produtos where cod_produto = '$cod_produto'";
        $query_produtos = mysqli_query($conexao, $sql);
        $row_produtos = mysqli_fetch_assoc($query_produtos);
        $nome_produto = $row_produtos['nome_produto'];
        $fornecedor = $row_produtos['fornecedor'];
        $valor_venda = $row_produtos['valor_venda'];

        // Consulta se o cliente tem compra realizada no dia de hoje
        $sql = "SELECT count(cod_produto) FROM controle_venda where data_venda = CURDATE() and cod_produto = '$cod_produto' and cpf_cliente = '$cpf'";
        $query_controle_venda = mysqli_query($conexao, $sql);
        $row_controle_venda = mysqli_fetch_assoc($query_controle_venda);

        // Se for igual a 0 cliente não tem compra realizada no dia de hoje então adiciona uma nova linha em controle_venda
        // Se não for igual a 0 cliente tem compra realiza no dia de hoje então realiza um update na linha já existente em controle_venda
        if ($row_controle_venda['count(cod_produto)'] == 0) {
            $sql = "INSERT INTO controle_venda (cod_produto, cpf_cliente, nome_produto, fornecedor, valor_venda, qtd_comprada, total_venda, data_venda) VALUES ('$cod_produto','$cpf', '$nome_produto', '$fornecedor', '$valor_venda','$qtd_comprada' ,$valor_venda * $qtd_comprada, NOW())";
        } else {
            $sql = "UPDATE controle_venda set qtd_comprada = $qtd_comprada + qtd_comprada, total_venda = $valor_venda * $qtd_comprada + total_venda where cod_produto = '$cod_produto' and data_venda = CURDATE() and cpf_cliente = '$cpf'";
        }

        // Se a consulta for bem-sucedida a compra é realizada 
        if (mysqli_query($conexao, $sql) === TRUE) {
            $_SESSION['compra_realizada'] = true;

            // Atualiza o estoque dos produtos na loja
            $sql = "UPDATE produtos set estoque = estoque - '$qtd_comprada' where cod_produto = '$cod_produto'";
            mysqli_query($conexao, $sql);

            // Consulta se o cliente já realizou a compra desse mesmo produto
            $sql = "SELECT count(cod_produto) FROM pedidos_concluidos where cod_produto = '$cod_produto' and cpf_cliente = '$cpf'";
            $query_pedidos_concluidos = mysqli_query($conexao, $sql);
            $row_pedidos_concluidos = mysqli_fetch_assoc($query_pedidos_concluidos);

            // Se for igual a 0 cliente não realizou a compra desse mesmo produto então adiciona uma nova linha em pedidos_concluidos
            // Se não for igual a 0 cliente já realizou a compra desse mesmo produto então realiza um update na linha já existente em pedidos_concluidos
            if ($row_pedidos_concluidos['count(cod_produto)'] == 0) {
                $sql = "INSERT INTO pedidos_concluidos (cpf_cliente, cod_produto, nome_produto, fornecedor, qtd_comprada, total_comprado, data_compra) VALUES ('$cpf', '$cod_produto', '$nome_produto', '$fornecedor','$qtd_comprada' ,$valor_venda * $qtd_comprada, CURDATE())";
            } else {
                $sql = "UPDATE pedidos_concluidos set qtd_comprada = $qtd_comprada + qtd_comprada, total_comprado = $valor_venda * $qtd_comprada + total_comprado, data_compra = CURDATE() where cod_produto = '$cod_produto' and cpf_cliente = '$cpf'";
            }

            // Remove o item do carrinho
            if (mysqli_query($conexao, $sql) === TRUE) {
                $sql = "DELETE from carrinho where cpf = '$cpf' and cod_produto = '$cod_produto'";
                mysqli_query($conexao, $sql);
            }
        }
    }
    mysqli_query($conexao, "SET sql_safe_updates=1");
} else {
    $_SESSION['nenhum_item_no_carrinho'] = true;
    header("Location: ../checkout.php");
    exit;
}


mysqli_close($conexao);
header("Location: ../checkout.php");
exit;

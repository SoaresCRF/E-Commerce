<?php
include("../verificar_acesso/login_dono.php");


function cadastrarFuncionario()
{
    session_start();
    include("../../_conect/conexao.php");

    $usuario = mysqli_real_escape_string($conexao, trim($_POST['usuario']));
    $cargo = mysqli_real_escape_string($conexao, trim($_POST['cargo']));


    // Verifica usuário
    if (!preg_match('/^[a-z0-9]+[a-z_]+[_]?[a-z0-9]$/', $usuario) or strlen($usuario) < 3 or strlen($usuario) > 30) {
        $_SESSION['usuario_invalido'] = true;
        header('Location: ../cadastrar_funcionario.php');
        exit;
    }


    // Consulta se o usuário existe
    $query_funcionarios = mysqli_query($conexao, "SELECT count(*) as total from funcionarios where usuario = '$usuario'");
    $row_funcionarios = mysqli_fetch_assoc($query_funcionarios);
    if ($row_funcionarios['total'] == 1) {
        $_SESSION['usuario_existe'] = true;
        header('Location: ../cadastrar_funcionario.php');
        exit;
    }


    // Cadastra novo usuário
    if (mysqli_query($conexao, "INSERT INTO funcionarios (usuario, cargo) VALUES ('$usuario', '$cargo')") === TRUE) {
        $_SESSION['status_cadastro'] = true;
    }


    mysqli_close($conexao);
    header('Location: ../cadastrar_funcionario.php');
    exit;
}


function cadastrarProduto()
{
    session_start();
    include("../../_conect/conexao.php");

    $cod_produto = mysqli_real_escape_string($conexao, trim($_POST['cod_produto']));
    $nome_produto = mysqli_real_escape_string($conexao, trim($_POST['nome_produto']));
    $fornecedor = mysqli_real_escape_string($conexao, trim($_POST['fornecedor']));
    $custo_produto = mysqli_real_escape_string($conexao, trim($_POST['custo_produto']));
    $valor_venda = $custo_produto * 2;
    $estoque = mysqli_real_escape_string($conexao, trim($_POST['estoque']));
    $categoria = mysqli_real_escape_string($conexao, trim($_POST['categoria']));


    // Consulta se nome e fornecedor do produto já existem
    $query_produtos = mysqli_query($conexao, "SELECT count(*) as total from produtos where nome_produto = '$nome_produto' and fornecedor = '$fornecedor'");
    $row_produtos = mysqli_fetch_assoc($query_produtos);
    if ($row_produtos['total'] == 1) {
        $_SESSION['produto_existe'] = true;
        header('Location: ../cadastrar_produto.php');
        exit;
    }


    // Consulta se código de produto já existe
    $query_produtos = mysqli_query($conexao, "SELECT count(*) as total from produtos where cod_produto = '$cod_produto'");
    $row_produtos = mysqli_fetch_assoc($query_produtos);
    if ($row_produtos['total'] == 1) {
        $_SESSION['cod_produto_existe'] = true;
        header('Location: ../cadastrar_produto.php');
        exit;
    }


    // Cadastra novo produto
    if (mysqli_query($conexao, "INSERT INTO produtos (cod_produto, nome_produto, fornecedor, custo_produto, valor_venda, estoque, data_cadastro, categoria) VALUES ('$cod_produto','$nome_produto', '$fornecedor', '$custo_produto', '$valor_venda', '$estoque', NOW(), '$categoria')") === TRUE) {
        $_SESSION['status_cadastro'] = true;
    }


    mysqli_close($conexao);
    header('Location: ../cadastrar_produto.php');
    exit;
}


function editarProduto()
{
    session_start();
    include("../../_conect/conexao.php");
    $cod_produto = mysqli_real_escape_string($conexao, trim($_POST['cod_produto']));
    //$nome_produto = mysqli_real_escape_string($conexao, trim($_POST['nome_produto']));
    //$fornecedor = mysqli_real_escape_string($conexao, trim($_POST['fornecedor']));
    $custo_produto = mysqli_real_escape_string($conexao, trim($_POST['custo_produto']));
    $valor_venda = mysqli_real_escape_string($conexao, trim($_POST['valor_venda']));
    $categoria = mysqli_real_escape_string($conexao, trim($_POST['categoria']));
    $estoque = mysqli_real_escape_string($conexao, trim($_POST['estoque']));




    // Consulta se o id do produto existe
    $query_produtos = mysqli_query($conexao, "SELECT count(*) as total from produtos where cod_produto = '$cod_produto'");
    $row_produtos = mysqli_fetch_assoc($query_produtos);
    if ($row_produtos['total'] == 0) {
        $_SESSION['cod_produto_nao_existe'] = true;
        header('Location: ../editar_produto.php');
        exit;
    }


    // Atualiza informação do produto cadastrado
    if (mysqli_query($conexao, "UPDATE produtos set categoria = '$categoria',custo_produto = '$custo_produto', valor_venda = '$valor_venda', estoque = '$estoque' + estoque, data_cadastro = NOW() where cod_produto = '$cod_produto'") === TRUE) {
        $_SESSION['status_editado'] = true;
    }


    mysqli_close($conexao);
    header('Location: ../editar_produto.php');
    exit;
}


if (isset($_POST["cadastrarFuncionario"]) == "cadastrarFuncionario") {
    cadastrarFuncionario();
} elseif (isset($_POST["cadastrarProduto"]) == "cadastrarProduto") {
    cadastrarProduto();
} elseif (isset($_POST["editarProduto"]) == "editarProduto") {
    editarProduto();
}

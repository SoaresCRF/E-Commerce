<?php
session_start();
include('../../_conect/conexao.php');

// Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
if (!empty($_POST) and (empty($_POST['username']) or empty($_POST['senha']))) {
    header('Location: ../login_cliente.php');
    exit();
}


$username = mysqli_real_escape_string($conexao, $_POST['username']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);


//Consulta a tabela de cliente cadastrados
$sql  = "SELECT username, senha, cpf, cargo, sexo from clientes_cadastrados where username = '$username' and senha = '$senha'";
$query_clientes_cadastrados  = mysqli_query($conexao, $sql);

// Verifica se os dados são inválidos e/ou o usuário não existe
if (mysqli_num_rows($query_clientes_cadastrados) != 1) {
    $_SESSION['nao_autenticado'] = true;
    header('Location: ../login_cliente.php');
    exit();
} else {
    // Salva os dados encontrados na variável
    $row_clientes_cadastrados  = mysqli_fetch_assoc($query_clientes_cadastrados);

    // Se a sessão não existir, inicia uma
    if (!isset($_SESSION)) session_start();

    // Salva os dados encontrados na tabela na $_SESSION
    $_SESSION['nome_cliente'] = $row_clientes_cadastrados['nome_cliente'];
    $_SESSION['username'] = $row_clientes_cadastrados['username'];
    $_SESSION['cpf'] = $row_clientes_cadastrados['cpf'];
    $_SESSION['cargo'] = $row_clientes_cadastrados['cargo'];
    $_SESSION['sexo'] = $row_clientes_cadastrados['sexo'];

    // Redireciona o login
    header('Location: ../todos_produtos.php');
    exit();
}

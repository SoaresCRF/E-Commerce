<?php
session_start();
include('_conect/conexao.php');

// Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
if (!empty($_POST) and (empty($_POST['usuario']) or empty($_POST['senha']))) {
	header('Location: index.php');
	exit();
}


$usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);


// Consulta se a conta é de funcionário
$sql  = "SELECT usuario_id, usuario, cargo from funcionarios where usuario = '$usuario' and senha = '$senha'";
$query_funcionarios  = mysqli_query($conexao, $sql);
if (mysqli_num_rows($query_funcionarios) != 1) {
	//Consulta se a conta é de cliente
	$sql  = "SELECT username, senha, cpf, cargo, sexo from clientes_cadastrados where username = '$usuario' and senha = '$senha'";
	$query_clientes_cadastrados  = mysqli_query($conexao, $sql);

	// Verifica se os dados são inválidos e/ou o usuário não existe
	if (mysqli_num_rows($query_clientes_cadastrados) != 1) {
		$_SESSION['nao_autenticado'] = true;
		header('Location: index.php');
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
		header('Location: cliente/todos_produtos.php');
		exit();
	}
}

// Consulta se o usuário foi desativado
$sql  = "SELECT usuario_id, usuario, cargo, ativo from funcionarios where usuario = '$usuario' and ativo = 1 limit 1";
$query_funcionarios = mysqli_query($conexao, $sql);


// Verifica se o usuário foi desativado
if (mysqli_num_rows($query_funcionarios) != 1) {
	$_SESSION['usuario_desativado'] = true;
	header('Location: index.php');
	exit();
} else {
	// Salva os dados encontrados na variável
	$row_funcionarios  = mysqli_fetch_assoc($query_funcionarios);

	// Se a sessão não existir, inicia uma
	if (!isset($_SESSION)) session_start();

	// Salva os dados encontrados na tabela na $_SESSION
	$_SESSION['usuario_id'] = $row_funcionarios['usuario_id'];
	$_SESSION['usuario'] = $row_funcionarios['usuario'];
	$_SESSION['cargo'] = $row_funcionarios['cargo'];

	// Redireciona o login
	header('Location: administracao/visualizar_produtos.php');
	exit();
}

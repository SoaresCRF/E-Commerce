<?php
include("../verificar_acesso/login_dono.php");
include("../../_conect/conexao.php");

$usuario_id = filter_input(INPUT_GET, "usuario_id", FILTER_SANITIZE_NUMBER_INT);

// Consulta se o id do funcionário existe
$sql = "SELECT count(*) as total from funcionarios where usuario_id = '$usuario_id'";
$query_funcionarios = mysqli_query($conexao, $sql);
$row_funcionarios = mysqli_fetch_assoc($query_funcionarios);
if ($row_funcionarios['total'] == 0) {
    $_SESSION['usuario_id_nao_existe'] = true;
    header('Location: ../visualizar_funcionarios.php');
    exit;
}

// Deleta o funcionário
$sql = "DELETE from funcionarios where usuario_id = '$usuario_id';";
if (mysqli_query($conexao, $sql) === TRUE) {
    $_SESSION['status_apagado'] = true;
}


mysqli_close($conexao);
header('Location: ../visualizar_funcionarios.php');
exit;

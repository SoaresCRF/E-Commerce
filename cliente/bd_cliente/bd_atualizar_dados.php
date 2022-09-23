<?php
include("../verificar_acesso/verifica_login_cliente.php");
include("../../_conect/conexao.php");


//Recebe o CPF do cliente logado
$cpf = $_SESSION['cpf'];


// Recebe dados do forms
$numero_casa    = mysqli_real_escape_string($conexao, trim($_POST['numero_casa']));
$celular        = mysqli_real_escape_string($conexao, trim($_POST['celular']));
$estado         = mysqli_real_escape_string($conexao, trim($_POST['estado']));
$cidade         = mysqli_real_escape_string($conexao, trim($_POST['cidade']));
$bairro         = mysqli_real_escape_string($conexao, trim($_POST['bairro']));
$email          = mysqli_real_escape_string($conexao, trim($_POST['email']));
$cep            = mysqli_real_escape_string($conexao, trim($_POST['cep']));
$rua            = mysqli_real_escape_string($conexao, trim($_POST['rua']));


// Funções
function verificarCampo($campos)
{
    foreach ($campos as $campo) {
        if (empty($campo)) {
            return true;
        }
    }

    return false;
}


//Verifica se todos os campos foram preenchidos
$campos = array($email, $celular, $cep, $estado, $cidade, $bairro, $rua, $numero_casa);
if (verificarCampo($campos)) {
    $_SESSION['preencha_campo'] = true;
    header('Location: ../checkout.php');
    exit;
}


//Validar email
if (!filter_var($email, FILTER_VALIDATE_EMAIL) or !preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $email)) {
    $_SESSION['email_invalido'] = true;
    header('Location: ../checkout.php');
    exit;
}


//Validar CEP
if (!preg_match('/^\d{5}-\d{3}$/', $cep)) {
    $_SESSION['cep_invalido'] = true;
    header('Location: ../checkout.php');
    exit;
}


//Validar DDD
$ddds = [11, 12, 13, 14, 15, 16, 17, 18, 19, 21, 22, 24, 27, 28, 31, 32, 33, 34, 35, 37, 38, 41, 42, 43, 44, 45, 46, 47, 48, 49, 51, 53, 54, 55, 61, 62, 64, 65, 66, 67, 68, 69, 71, 73, 74, 75, 77, 79, 81, 86, 87, 89, 91, 92, 93, 94, 95, 96, 97, 98, 99];

$ddd =  $celular[1] . $celular[2];
if (!in_array($ddd, $ddds)) {
    $_SESSION['ddd_invalido'] = true;
    header('Location: ../checkout.php');
    exit;
}


//Validar celular
if (!preg_match('/^\([1-9]{2}\)\s9\d{4}-\d{4}$/', $celular)) {
    $_SESSION['celular_invalido'] = true;
    header('Location: ../checkout.php');
    exit;
}


//Validar número casa
if (!is_numeric($numero_casa) or strlen($numero_casa) < 1 or strlen($numero_casa) > 7) {
    $_SESSION['numero_casa_invalido'] = true;
    header('Location: ../checkout.php');
    exit;
}


//Validar estado
if (!preg_match("/^[A-Z]*$/", $estado) or strlen($estado) != 2) {
    $_SESSION['estado_invalido'] = true;
    header('Location: ../checkout.php');
    exit;
}


//Validar cidade
if (!preg_match("/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ' ]{3,}$/", $cidade)) {
    $_SESSION['cidade_invalido'] = true;
    header('Location: ../checkout.php');
    exit;
}


//Validar bairro
if (!preg_match("/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ' ]{3,}$/", $bairro)) {
    $_SESSION['bairro_invalido'] = true;
    header('Location: ../checkout.php');
    exit;
}


//Validar rua
if (!preg_match("/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ' ]{3,}$/", $rua)) {
    $_SESSION['rua_invalido'] = true;
    header('Location: ../checkout.php');
    exit;
}


//Verifica se o email cadastrado é do cliente atual
$query_clientes_cadastrados = mysqli_query($conexao, "SELECT count(*) as total from clientes_cadastrados where email = '$email' and cpf = '$cpf'");
$row_clientes_cadastrados = mysqli_fetch_assoc($query_clientes_cadastrados);
if ($row_clientes_cadastrados['total'] != 1) {
    //Se não for verifica se o email já foi cadastrado
    $query_clientes_cadastrados = mysqli_query($conexao, "SELECT count(*) as total from clientes_cadastrados where email = '$email'");
    $row_clientes_cadastrados = mysqli_fetch_assoc($query_clientes_cadastrados);
    if ($row_clientes_cadastrados['total'] == 1) {
        $_SESSION['email_existe'] = true;
        header('Location: ../checkout.php');
        exit;
    }
}


//Extrai apenas os números
$numero_casa = preg_replace('/[^0-9]/', "", $numero_casa);
$celular = preg_replace('/[^0-9]/', "", $celular);
$cep = preg_replace('/[^0-9]/', "", $cep);


//Atualiza os dados do cliente
mysqli_query($conexao, "UPDATE clientes_cadastrados set numero_casa = '$numero_casa', celular = '$celular', estado = '$estado', cidade = '$cidade', bairro = '$bairro', email = '$email', cep = '$cep', rua = '$rua' where cpf = '$cpf'");


mysqli_close($conexao);
header("Location: ../checkout.php");
exit;

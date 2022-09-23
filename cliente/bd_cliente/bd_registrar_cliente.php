<?php
include("../../_conect/conexao.php");
session_start();


// Recebe dados do forms
$confirma_senha = mysqli_real_escape_string($conexao, trim($_POST['confirma_senha']));
$nome_cliente   = mysqli_real_escape_string($conexao, trim($_POST['nome_cliente']));
$numero_casa    = mysqli_real_escape_string($conexao, trim($_POST['numero_casa']));
$data_nasc      = mysqli_real_escape_string($conexao, trim($_POST['data_nasc']));
$username       = mysqli_real_escape_string($conexao, trim($_POST['username']));
$celular        = mysqli_real_escape_string($conexao, trim($_POST['celular']));
$estado         = mysqli_real_escape_string($conexao, trim($_POST['estado']));
$cidade         = mysqli_real_escape_string($conexao, trim($_POST['cidade']));
$bairro         = mysqli_real_escape_string($conexao, trim($_POST['bairro']));
$senha          = mysqli_real_escape_string($conexao, trim($_POST['senha']));
$email          = mysqli_real_escape_string($conexao, trim($_POST['email']));
$sexo           = mysqli_real_escape_string($conexao, trim($_POST['sexo']));
$cep            = mysqli_real_escape_string($conexao, trim($_POST['cep']));
$cpf            = mysqli_real_escape_string($conexao, trim($_POST['cpf']));
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

function validarCPF($cpf)
{

    // Extrai somente os números
    $cpf = preg_replace('/[^0-9]/', "", $cpf);


    // Verifica se foi informado onze dígitos e se foi informada uma sequência de dígitos repetidos. Ex: 111.111.111-11
    if (strlen($cpf) != 11 || preg_match('/([0-9])\1{10}/', $cpf)) {
        return false;
    }


    // Faz o calculo para validar o CPF
    $number_quantity_to_loop = [9, 10];

    foreach ($number_quantity_to_loop as $item) {

        $sum = 0;
        $number_to_multiplicate = $item + 1;

        for ($index = 0; $index < $item; $index++) {

            $sum += $cpf[$index] * ($number_to_multiplicate--);
        }

        $result = (($sum * 10) % 11);

        if ($cpf[$item] != $result) {
            return false;
        }
    }

    return true;
}


//Verifica se todos os campos foram preenchidos
$campos = array($nome_cliente, $email, $celular, $data_nasc, $sexo, $cep, $estado, $cidade, $bairro, $cpf, $rua, $numero_casa, $username, $senha, $confirma_senha);
if (verificarCampo($campos)) {
    $_SESSION['preencha_campo'] = true;
    header('Location: ../registrar_cliente.php');
    exit;
}


//Validar email
if (!filter_var($email, FILTER_VALIDATE_EMAIL) or !preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $email)) {
    $_SESSION['email_invalido'] = true;
    header('Location: ../registrar_cliente.php');
    exit;
}


//Validar username
if (!preg_match('/^[a-z]\w{6,13}[^_]$/i', $username)) {
    $_SESSION['username_invalido'] = true;
    header('Location: ../registrar_cliente.php');
    exit;
}


//Validar nome
if (!preg_match("/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ' ]{3,}$/", $nome_cliente)) {
    $_SESSION['nome_cliente_invalido'] = true;
    header('Location: ../registrar_cliente.php');
    exit;
}


//Validar CEP
if (!preg_match('/^\d{5}-\d{3}$/', $cep)) {
    $_SESSION['cep_invalido'] = true;
    header('Location: ../registrar_cliente.php');
    exit;
}


//Validar celular
if (!preg_match('/^\([1-9]{2}\)\s9\d{4}-\d{4}$/', $celular)) {
    $_SESSION['celular_invalido'] = true;
    header('Location: ../registrar_cliente.php');
    exit;
}


//Validar DDD
$ddds = [11, 12, 13, 14, 15, 16, 17, 18, 19, 21, 22, 24, 27, 28, 31, 32, 33, 34, 35, 37, 38, 41, 42, 43, 44, 45, 46, 47, 48, 49, 51, 53, 54, 55, 61, 62, 64, 65, 66, 67, 68, 69, 71, 73, 74, 75, 77, 79, 81, 86, 87, 89, 91, 92, 93, 94, 95, 96, 97, 98, 99];

$ddd =  $celular[1] . $celular[2];
if (!in_array($ddd, $ddds)) {
    $_SESSION['ddd_invalido'] = true;
    header('Location: ../registrar_cliente.php');
    exit;
}


//Validar CPF
if (!validarCPF($cpf)) {
    $_SESSION['cpf_invalido'] = true;
    header('Location: ../registrar_cliente.php');
    exit;
}


//Validar número casa
if (!is_numeric($numero_casa) or strlen($numero_casa) < 1 or strlen($numero_casa) > 7) {
    $_SESSION['numero_casa_invalido'] = true;
    header('Location: ../registrar_cliente.php');
    exit;
}


//Validar estado
if (!preg_match("/^[A-Z]*$/", $estado) or strlen($estado) != 2) {
    $_SESSION['estado_invalido'] = true;
    header('Location: ../registrar_cliente.php');
    exit;
}


//Validar cidade
if (!preg_match("/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ' ]{3,}$/", $cidade)) {
    $_SESSION['cidade_invalido'] = true;
    header('Location: ../registrar_cliente.php');
    exit;
}


//Validar bairro
if (!preg_match("/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ' ]{3,}$/", $bairro)) {
    $_SESSION['bairro_invalido'] = true;
    header('Location: ../registrar_cliente.php');
    exit;
}


//Validar rua
if (!preg_match("/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ' ]{3,}$/", $rua)) {
    $_SESSION['rua_invalido'] = true;
    header('Location: ../registrar_cliente.php');
    exit;
}


//Verifica se já existe email cadastrado
$query_clientes_cadastrados = mysqli_query($conexao, "SELECT count(*) as total from clientes_cadastrados where email = '$email'");
$row_clientes_cadastrados = mysqli_fetch_assoc($query_clientes_cadastrados);
if ($row_clientes_cadastrados['total'] == 1) {
    $_SESSION['email_existe'] = true;
    header('Location: ../registrar_cliente.php');
    exit;
}


//Verifica se já existe CPF cadastrado
$cpf = preg_replace('/[^0-9]/', "", $cpf);

$query_clientes_cadastrados = mysqli_query($conexao, "SELECT count(*) as total from clientes_cadastrados where cpf = '$cpf'");
$row_clientes_cadastrados = mysqli_fetch_assoc($query_clientes_cadastrados);
if ($row_clientes_cadastrados['total'] == 1) {
    $_SESSION['cpf_existe'] = true;
    header('Location: ../registrar_cliente.php');
    exit;
}


//Verifica se já existe username cadastrado
$query_clientes_cadastrados = mysqli_query($conexao, "SELECT count(*) as total from clientes_cadastrados where username = '$username'");
$row_clientes_cadastrados = mysqli_fetch_assoc($query_clientes_cadastrados);
if ($row_clientes_cadastrados['total'] == 1) {
    $_SESSION['username_existe'] = true;
    header('Location: ../registrar_cliente.php');
    exit;
}


//Verifica força da senha
$maiusculo     = preg_match('@[A-Z]@', $senha);
$minusculo     = preg_match('@[a-z]@', $senha);
$numero        = preg_match('@[0-9]@', $senha);
$charsEspecial = preg_match('@[^\w]@', $senha);
if (!$maiusculo or !$minusculo or !$numero or !$charsEspecial or strlen($senha) < 8 or strlen($senha) > 20) {
    $_SESSION['forca_senha'] = true;
    header('Location: ../registrar_cliente.php');
    exit;
}


//Verifica se as senhas são iguais
if ($senha != $confirma_senha) {
    $_SESSION['senha_diferentes'] = true;
    header('Location: ../registrar_cliente.php');
    exit;
}


//Cadastra novo cliente

//Extrai apenas os números
$cep = preg_replace('/[^0-9]/', "", $cep);
$celular = preg_replace('/[^0-9]/', "", $celular);

if (mysqli_query($conexao, "INSERT INTO clientes_cadastrados VALUES ('$nome_cliente', '$cpf', '$email', '$celular', '$data_nasc', '$sexo', '$cep', '$estado', '$cidade', '$bairro', '$rua', '$numero_casa', '$username', '$senha', NOW(), 'cliente')") === TRUE) {
    $_SESSION['cliente_cadastrado'] = true;
}


mysqli_close($conexao);
header('Location: ../../index.php');
exit;

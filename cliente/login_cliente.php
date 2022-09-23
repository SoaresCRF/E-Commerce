<?php
include("../_conect/conexao.php");
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr" style="background-color: #151515;">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../css/registrar_cliente.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="../css/bulma.min.css" />
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body style="background: #151515;">
    <div class="container">
        <?php
        if (isset($_SESSION['nao_autenticado'])) :
        ?>
            <div class="notification is-danger">
                <p>Usuário ou senha incorretos</p>
            </div>
        <?php
        endif;
        unset($_SESSION['nao_autenticado']);
        ?>

        <div class="content">
            <form action="bd_cliente/bd_login_cliente.php" method="POST">
                <div class="title">Informação de login</div>

                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Username</span>
                        <input pattern="^(?=.{8,15}$)(?![_])[a-zA-Z0-9_]+(?<![_])$" title="Deve conter entre 8 e 15 caracteres só é permitido sublinhado e não pode começar nem terminar com sublinhado" name="username" minlength="8" maxlength="15" id="animacaoInput" type="text" placeholder="Informe user para login" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Senha</span>
                        <div class="input-group" id="show_hide_password">
                            <input pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^\w]).{8,20}" title="Deve conter entre 8 e 20 caracteres, pelo menos um número, um caracter especial, uma letra maiúscula e minúscula" minlength="8" maxlength="20" name="senha" id="password" type="password" placeholder="Sua senha" required class="form-control">
                            <div class="input-group-addon">
                                <i toggle="#password" class="fa fa-eye-slash toggle-password" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="butaoforms" class="button">
                    <input id="butaoforms" type="submit" value="Login">
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="../js/ver_senha.js"></script>
</body>

</html>
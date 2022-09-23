<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>BEM-VINDO</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
    <div class="login-form">
        <div class="text">
            <p> LOGIN</p>
            <?php
            if (isset($_SESSION['nao_autenticado'])) :
            ?>
                <div class="notification is-danger">
                    <p style="color: red; font-size: 17.9px;">Usuário ou senha inválidos.</p>
                </div>
            <?php
            endif;
            unset($_SESSION['nao_autenticado']);
            ?>

            <?php
            if (isset($_SESSION['usuario_desativado'])) :
            ?>
                <div class="notification is-danger">
                    <p style="color: red; font-size: 17.9px;">Usuário desativado.</p>
                </div>
            <?php
            endif;
            unset($_SESSION['usuario_desativado']);
            ?>

        </div>
        <form action="login.php" method="POST">
            <div class="field">
                <div class="fas fa-solid fa-user"></div>
                <input name="usuario" type="text" placeholder="Usuário" autofocus>
            </div>
            <div class="field">
                <div class="fas fa-lock"></div>
                <input maxlength="12" name="senha" type="password" placeholder="Senha">
            </div>
            <button type="submit">ENTRAR</button>
            <a style="text-decoration: none;" href="cliente/todos_produtos.php">
                <p style="color: #868686; margin-top: 10px;">Vistar loja</p>
            </a>
        </form>
    </div>
</body>

</html>
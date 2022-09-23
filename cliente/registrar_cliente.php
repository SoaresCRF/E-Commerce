<?php
include("../_conect/conexao.php");
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr" style="background-color: #151515;">

<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="../css/registrar_cliente.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="../css/bulma.min.css" />
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body style="background: #151515;">
    <div class="container" style="margin-top: 280px;">
        <?php
        if (isset($_SESSION['preencha_campo'])) :
        ?>
            <div class="notification is-danger">
                <p>Preencha todos os campos</p>
            </div>
        <?php
        endif;
        unset($_SESSION['preencha_campo']);
        ?>


        <?php
        if (isset($_SESSION['email_invalido'])) :
        ?>
            <div class="notification is-danger">
                <p>Email inválido</p>
            </div>
        <?php
        endif;
        unset($_SESSION['email_invalido']);
        ?>


        <?php
        if (isset($_SESSION['username_invalido'])) :
        ?>
            <div class="notification is-danger">
                <p>Username inválido</p>
            </div>
        <?php
        endif;
        unset($_SESSION['username_invalido']);
        ?>


        <?php
        if (isset($_SESSION['nome_cliente_invalido'])) :
        ?>
            <div class="notification is-danger">
                <p>Nome inválido</p>
            </div>
        <?php
        endif;
        unset($_SESSION['nome_cliente_invalido']);
        ?>


        <?php
        if (isset($_SESSION['cep_invalido'])) :
        ?>
            <div class="notification is-danger">
                <p>CEP inválido</p>
            </div>
        <?php
        endif;
        unset($_SESSION['cep_invalido']);
        ?>


        <?php
        if (isset($_SESSION['celular_invalido'])) :
        ?>
            <div class="notification is-danger">
                <p>Celular inválido</p>
            </div>
        <?php
        endif;
        unset($_SESSION['celular_invalido']);
        ?>


        <?php
        if (isset($_SESSION['ddd_invalido'])) :
        ?>
            <div class="notification is-danger">
                <p>DDD inválido</p>
            </div>
        <?php
        endif;
        unset($_SESSION['ddd_invalido']);
        ?>


        <?php
        if (isset($_SESSION['cpf_invalido'])) :
        ?>
            <div class="notification is-danger">
                <p>CPF inválido</p>
            </div>
        <?php
        endif;
        unset($_SESSION['cpf_invalido']);
        ?>


        <?php
        if (isset($_SESSION['numero_casa_invalido'])) :
        ?>
            <div class="notification is-danger">
                <p>Número casa inválido</p>
            </div>
        <?php
        endif;
        unset($_SESSION['numero_casa_invalido']);
        ?>

        <?php
        if (isset($_SESSION['estado'])) :
        ?>
            <div class="notification is-danger">
                <p>Estado inválido</p>
            </div>
        <?php
        endif;
        unset($_SESSION['estado']);
        ?>


        <?php
        if (isset($_SESSION['cidade_invalido'])) :
        ?>
            <div class="notification is-danger">
                <p>Cidade inválido</p>
            </div>
        <?php
        endif;
        unset($_SESSION['cidade_invalido']);
        ?>


        <?php
        if (isset($_SESSION['bairro_invalido'])) :
        ?>
            <div class="notification is-danger">
                <p>Bairro inválido</p>
            </div>
        <?php
        endif;
        unset($_SESSION['bairro_invalido']);
        ?>


        <?php
        if (isset($_SESSION['rua_invalido'])) :
        ?>
            <div class="notification is-danger">
                <p>Rua inválido</p>
            </div>
        <?php
        endif;
        unset($_SESSION['rua_invalido']);
        ?>

        <?php
        if (isset($_SESSION['email_existe'])) :
        ?>
            <div class="notification is-danger">
                <p>Email já cadastrado</p>
            </div>
        <?php
        endif;
        unset($_SESSION['email_existe']);
        ?>


        <?php
        if (isset($_SESSION['cpf_existe'])) :
        ?>
            <div class="notification is-danger">
                <p>CPF já cadastrado</p>
            </div>
        <?php
        endif;
        unset($_SESSION['cpf_existe']);
        ?>


        <?php
        if (isset($_SESSION['username_existe'])) :
        ?>
            <div class="notification is-danger">
                <p>Username já cadastrado</p>
            </div>
        <?php
        endif;
        unset($_SESSION['username_existe']);
        ?>


        <?php
        if (isset($_SESSION['forca_senha'])) :
        ?>
            <div class="notification is-danger">
                <p>A senha deve ter entre 8 e 20 caracteres e deve incluir pelo menos uma letra maiúscula, um número e um caractere especial.</p>
            </div>
        <?php
        endif;
        unset($_SESSION['forca_senha']);
        ?>


        <?php
        if (isset($_SESSION['senha_diferentes'])) :
        ?>
            <div class="notification is-danger">
                <p>As senhas não se correspondem</p>
            </div>
        <?php
        endif;
        unset($_SESSION['senha_diferentes']);
        ?>


        <div class="content">
            <form action="bd_cliente/bd_registrar_cliente.php" method="POST">

                <div class="title">Detalhes pessoais</div>
                
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Nome completo</span>
                        <input name="nome_cliente" id="animacaoInput" type="text" placeholder="Sua informação" required>
                    </div>

                    <div class="input-box">
                        <span class="details">CPF</span>
                        <input name="cpf" id="cpf" type="text" placeholder="Informe somente números" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Email</span>
                        <input name="email" id="animacaoInput" type="text" placeholder="Email válido" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Número celular</span>
                        <input name="celular" id="phone_with_ddd" type="text" placeholder="Informe somente números" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Data de nascimento</span>
                        <input name="data_nasc" id="animacaoInput" type="date" placeholder="Informa somente números" required>
                    </div>
                </div>

                <div class="gender-details">
                    <input type="radio" name="sexo" value="H" id="dot-1">
                    <input type="radio" name="sexo" value="F" id="dot-2">
                    <input type="radio" name="sexo" value="NI" id="dot-3">
                    <span class="gender-title">Sexo</span>
                    <div class="category">
                        <label for="dot-1">
                            <span class="dot one"></span>
                            <span class="gender">Homem</span>
                        </label>
                        <label for="dot-2">
                            <span class="dot two"></span>
                            <span class="gender">Mulher</span>
                        </label>
                        <label for="dot-3">
                            <span class="dot three"></span>
                            <span class="gender">Prefiro não informa</span>
                        </label>
                    </div>
                </div>

                <div class="title">Endereço</div>

                <div class="user-details">
                    <div class="input-box">
                        <span class="details ">CEP</span>
                        <input name="cep" id="cep" type="text" placeholder="Informa somente números" onblur="pesquisacep(this.value);" required>
                        <a href="#" onclick="javascript:abrirEmPopup('https://buscacepinter.correios.com.br/app/localidade_logradouro/index.php', 1025, 550);">Não sei meu CEP</a>
                    </div>

                    <div class="input-box">
                        <span class="details">Estado</span>
                        <input name="estado" id="uf" type="text" placeholder="Seu estado" readonly required>
                    </div>

                    <div class="input-box">
                        <span class="details">Cidade</span>
                        <input name="cidade" id="cidade" type="text" placeholder="Sua cidade" readonly required>
                    </div>

                    <div class="input-box">
                        <span class="details">Bairro</span>
                        <input name="bairro" id="bairro" type="text" placeholder="Seu bairro" readonly required>
                    </div>

                    <div class="input-box">
                        <span class="details">Rua</span>
                        <input name="rua" id="rua" type="text" placeholder="Sua rua" readonly required>
                    </div>

                    <div class="input-box">
                        <span class="details">Número</span>
                        <input name="numero_casa" pattern="[0-9]+" title="Somente números" type="text" minlength="1" maxlength="7" id="somenteNumero" placeholder="Número casa" required>
                    </div>
                </div>

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

                    <div class="input-box">
                        <span class="details">Confirmação senha</span>
                        <div class="input-group" id="show_hide_password">
                            <input maxlength="20" name="confirma_senha" id="confirm_password" type="password" placeholder="Repita sua senha" required class="form-control">
                            <div class="input-group-addon">
                                <i toggle="#confirm_password" class="fa fa-eye-slash toggle-password" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="butaoforms" class="button">
                    <input id="butaoforms" type="submit" value="Registrar">
                </div>
            </form>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="../js/senha_corresponde.js"></script>
    <script src="../js/abrirEmPopup.js"></script>
    <script src="../js/ver_senha.js"></script>
    <script src="../js/via_vep.js"></script>
    <script src="../js/mask.js"></script>
</body>

</html>
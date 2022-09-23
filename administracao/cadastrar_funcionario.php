<?php 
include ("verificar_acesso/login_dono.php");
include("header.php"); 
?>

<section class="home-section">
    <div class="home-content">
        <i class='bx bx-menu'></i>
    </div>

    <div class="container-fluid" style="width: inherit;">
        <!-- Pode tirar o inherit -->
        <div class="container has-text-centered">
            <div class="column is-4 is-offset-4">
                <h3 class="title has-text-grey">Cadastrar funcionário</h3>

                <?php
                if (isset($_SESSION['status_cadastro'])) :
                ?>
                    <div class="notification is-success">
                        <p>Cadastro efetuado!</p>
                    </div>
                <?php
                endif;
                unset($_SESSION['status_cadastro']);
                ?>


                <?php
                if (isset($_SESSION['usuario_invalido'])) :
                ?>
                    <div class="notification is-info">
                        <p>Usuário inválido!</p>
                    </div>
                <?php
                endif;
                unset($_SESSION['usuario_invalido']);
                ?>


                <?php
                if (isset($_SESSION['usuario_existe'])) :
                ?>
                    <div class="notification is-info">
                        <p>Usuário como mesmo nome. Informe outro e tente novamente.</p>
                    </div>
                <?php
                endif;
                unset($_SESSION['usuario_existe']);
                ?>
            </div>

        </div>
        <div class="row">
            <div class="col-sm">
                <!-- Conteúdo -->
                <div class="hero-body">
                    <div class="container has-text-centered">
                        <div class="column is-4 is-offset-4">
                            <div class="box">
                                <form action="bd_administracao/bd_gerente.php" method="POST">
                                    <div class="field">
                                        <div class="control">
                                            <input pattern="^[a-z0-9]+[a-z_]+[_]?[a-z0-9]$" title="Somente letras minúsculas, números e sublinhado, use sublinhado para representar espaços e não pode terminar com sublinhado. Entre 2 e 30 caracteres." maxlength="30" id="animacaoInput" name="usuario" type="text" class="input is-large" placeholder="Usuário" autofocus required>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <div class="control">
                                            <input id="inputDesabilitado" disabled type="password" class="input is-large" placeholder="Senha padrão: 123" required>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <div class="control">
                                            <fieldset><span style="font-weight: bold; font-size: 16px;">Cargo</span></fieldset>
                                            <input type="radio" name="cargo" value="dono"> Dono <br>
                                            <input type="radio" name="cargo" value="gerente"> Gerente
                                        </div>
                                    </div>

                                    <button id="butaoforms" name="cadastrarFuncionario" value="cadastrarFuncionario" type="submit" class="button is-block is-link is-large is-fullwidth">Cadastrar</button>
                                    <p style="margin-top: 10px; "><a style="text-decoration: none; color: #11101D;" href="visualizar_funcionarios.php">Visualizar funcionários cadastrados</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include("footer.php"); ?>
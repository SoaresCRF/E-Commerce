<?php
include("verificar_acesso/login_dono.php");
include("header.php");
?>

<section class="home-section">
    <div class="home-content">
        <i class='bx bx-menu'></i>
    </div>
    <div class="container-fluid" style="width: inherit;">
        <!-- Pode tirar o inherit -->
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <?php
                if (isset($_SESSION['status_apagado'])) :
                ?>
                    <div class="notification is-success">
                        <p>Exclusão de dado realizada!</p>
                    </div>
                <?php
                endif;
                unset($_SESSION['status_apagado']);
                ?>

                <?php
                if (isset($_SESSION['usuario_desativado'])) :
                ?>
                    <div class="notification is-success">
                        <p>Usuário desativado com sucesso!</p>
                    </div>
                <?php
                endif;
                unset($_SESSION['usuario_desativado']);
                ?>

                <?php
                if (isset($_SESSION['usuario_ativado'])) :
                ?>
                    <div class="notification is-success">
                        <p>Usuário ativado com sucesso!</p>
                    </div>
                <?php
                endif;
                unset($_SESSION['usuario_ativado']);
                ?>


                <?php
                if (isset($_SESSION['usuario_id_nao_existe'])) :
                ?>
                    <div class="notification is-info">
                        <p>ID usuário não encontrado. <a href="visualizar_funcionario.php">Visualizar funcionário cadastrados.</a></p>
                    </div>
                <?php
                endif;
                unset($_SESSION['usuario_id_nao_existe']);
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <!-- Conteúdo -->
                <div class="table-responsive">
                    <table id="visualizar-funcionario" class="display table" style="width:100%">
                        <thead class="table-dark">
                            <tr>
                                <th id="tabela-head-white" scope="col">#</th>
                                <th id="tabela-head-white" scope="col">Usuário</th>
                                <th id="tabela-head-white" scope="col">Senha</th>
                                <th id="tabela-head-white" scope="col">Cargo</th>
                                <th id="tabela-head-white" scope="col">Status</th>
                                <th id="tabela-head-white" scope="col">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM funcionarios order by ativo desc, cargo, usuario, usuario_id";
                            $query_funcionarios = mysqli_query($conexao, $sql);
                            while ($row_funcionarios = mysqli_fetch_assoc($query_funcionarios)) { ?>
                                <tr>
                                    <?php if ($row_funcionarios['ativo'] == 1) { ?>
                                        <th class="table-success" scope="row"><?php echo $row_funcionarios['usuario_id']; ?></th>
                                        <td class="table-success"><?php echo $row_funcionarios['usuario']; ?></td>
                                        <td class="table-success"><?php echo $row_funcionarios['senha']; ?></td>
                                        <td class="table-success"><?php echo $row_funcionarios['cargo']; ?></td>
                                        <td class="table-success">
                                            <a href='bd_administracao/bd_desativar_funcionario.php?usuario_id=<?php echo $row_funcionarios['usuario_id']; ?>'><button class='close'><span style='color: gray; font-size: 15px;'> Desativar</span></button></a>
                                        </td>
                                        <td class="table-success">
                                            <a title="Deletar" href='bd_administracao/bd_apagar_funcionario.php?usuario_id=<?php echo $row_funcionarios['usuario_id']; ?>'><button class='close'><i id="tabela-deletar" style="font-size: 15px;" class="fa-solid fa-x"></i></button></a>
                                        </td>
                                    <?php } else { ?>
                                        <th class="table-secondary" scope="row"><?php echo $row_funcionarios['usuario_id']; ?></th>
                                        <td class="table-secondary"><?php echo $row_funcionarios['usuario']; ?></td>
                                        <td class="table-secondary"><?php echo $row_funcionarios['senha']; ?></td>
                                        <td class="table-secondary"><?php echo $row_funcionarios['cargo']; ?></td>
                                        <td class="table-secondary">
                                            <a href='bd_administracao/bd_ativar_funcionario.php?usuario_id=<?php echo $row_funcionarios['usuario_id']; ?>'><button class='close'><span style='color: green; font-size: 15px;'> Ativar</span></button></a>
                                        </td>
                                        <td class="table-secondary">
                                            <a title="Deletar" href='bd_administracao/bd_apagar_funcionario.php?usuario_id=<?php echo $row_funcionarios['usuario_id']; ?>'><button class='close'><i id="tabela-deletar" style="font-size: 15px;" class="fa-solid fa-x"></i></button></a>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#visualizar-funcionario').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json'
            }
        });
    });
</script>
<?php include("footer.php"); ?>
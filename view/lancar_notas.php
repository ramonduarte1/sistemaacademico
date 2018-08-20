<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/css.css">
        <meta charset="UTF-8">
        <title></title>
        <script type='text/javascript' src="../js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript">
            function consultaAluno() {

                $.ajax({
                    type: "POST",
                    url: "../Consultas/consultaAlunosMatriculados.php",
                    data: 'pesq_aluno=' + $('#pesq_aluno').val(),
                    success: function (data) {
                        $('#tabelaAluno').html(data);

                    }
                });
            }
        </script>
    </head>
    <body>
        <?php
        session_start();
        include 'menu.php';
        ?>
        <h2 class="centralizado">Pesquisar Aluno</h2><br><br>
        <table border="0">
            <tr>
                <td>Pesquisa por Nome : </td>
                <td>
                    <input required="" type="text" size="50" id="pesq_aluno" name="pesq_aluno">
                </td>
                <td>
                    <button onclick="consultaAluno()">Pesquisar</button>
                </td>
            </tr>
        </table>
        <br><br>
        <div class="centralizado" id="tabelaAluno"></div>
        <br><br>
        <table border='1'>

            <?php if (isset($_SESSION['alunos_matriculados'])): ?>
                <tr><th colspan="11" class="centralizado">Aluno</th></tr>
                <tr>
                    <td>Matricula</td>
                    <td><input size="4" readonly value="<?php echo $_SESSION['alunos_matriculados'][1]; ?>"></td>
                    <td>Aluno</td>
                    <td  colspan="3"><input readonly value="<?php echo $_SESSION['alunos'][$_SESSION['aluno_disciplina']['aluno']]['nome']; ?>"></td>
                    <td>Email</td>
                    <td><input readonly value="<?php echo $_SESSION['alunos'][$_SESSION['aluno_disciplina']['aluno']]['email']; ?>"></td>
                </tr>
                <tr><th colspan="7" class="centralizado">Disciplinas</th></tr>
                <?php foreach ($_SESSION['alunos_matriculados'] as $codigo): ?>
                    <tr>
                        <td>Codigo</td>
                        <td><input size="4" name="" readonly value="<?php echo $codigo; ?>"></td>
                        <td>Disciplina</td>
                        <td><input readonly name="" value="<?php echo $_SESSION['disciplinas'][$codigo]['nome'] ?>"></td>
                        <td>Notas 1</td>
                        <td><input type="text" size="2"></td>
                        <td>Notas 2</td>
                        <td><input type="text" size="2"></td>
                        <td>Notas 3</td>
                        <td><input type="text" size="2"></td>
                        <td><button>salvar</button></td>
                    </tr>
                <?php endforeach; ?>
                <tr><th colspan="7" class="centralizado">Turmas</th></tr>
                        <?php foreach ($_SESSION['aluno_disciplina']['turmas'] as $codigo): ?>
                    <tr>
                        <td>Codigo</td>
                        <td><input size="4" name="" readonly value="<?php echo $codigo; ?>"></td>
                        <td>Turmas</td>
                        <td colspan="3"><input size="52" readonly name="" value="<?php echo $_SESSION['turmas'][$codigo]['nome'] ?>"></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="6"></td>
                    <td>
                        <form action="" method="post">
                            <!--pega a sessao aluno_disciplina e faz a matricula-->
                            <button>Salvar</button></td>
                    </form>
                </tr>
            <?php endif; ?>
        </table> 
    </body>
</html>

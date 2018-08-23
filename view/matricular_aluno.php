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
            function consultaNome() {
//                if ($("#buscar").val() == "") {
//                    alert('Por favor, preencha o campo');
//                    return false
//                }
                var nome = document.getElementById('buscar').value;
                $.ajax({
                    type: "POST",
                    url: "../Consultas/matricularAluno.php",
                    data: 'pesq_aluno=' + nome,
                    success: function (data) {
                        $('#alunos').html(data);

                    }
                });
            }
            function consultaNomeDisciplina() {
//                if ($("#buscar_disciplina").val() == "") {
//                    alert('Por favor, preencha o campo');
//                    return false
//                }
                var nome = document.getElementById('buscar_disciplina').value;
                $.ajax({
                    type: "POST",
                    url: "../Consultas/matricularDisciplina.php",
                    data: 'pesq_disciplina=' + nome,
                    success: function (data) {
                        $('#disciplinas').html(data);

                    }
                });
            }
            function consultaNomeTurma() {
//                if ($("#buscar_turma").val() == "") {
//                    alert('Por favor, preencha o campo');
//                    return false
//                }
                var nome = document.getElementById('buscar_turma').value;
                $.ajax({
                    type: "POST",
                    url: "../Consultas/matricularTurmas.php",
                    data: 'pesq_turma=' + nome,
                    success: function (data) {
                        $('#turmas').html(data);

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
        <h2 class="centralizado">Matricular Aluno</h2><br><br>
        <table border="0">
            <tr>
                <td class="direita">Nome Aluno:</td>
                <td><input size="60" type="text" id="buscar" name="buscar"></td>
                <td><button  onclick="consultaNome()">buscar</button></td>
            </tr>
            <tr>
                <td colspan="4">
                    <div id="alunos"></div>
                </td>
            </tr>
            <tr>
                <td class="direita">Nome da Disciplina:</td>
                <td><input size="60" type="text" id="buscar_disciplina" name="buscar_disciplina"></td>
                <td><button  onclick="consultaNomeDisciplina()">buscar</button></td>
            </tr>
            <tr>
                <td colspan="4">
                    <div id="disciplinas"></div>
                </td>
            </tr>
            <tr>
                <td class="direita">Nome da Turma:</td>
                <td><input size="60" type="text" id="buscar_turma" name="buscar_turma"></td>
                <td><button  onclick="consultaNomeTurma()">buscar</button></td>
            </tr>
            <tr>
                <td colspan="4">
                    <div id="turmas"></div>
                </td>
            </tr>
        </table>
        <table border='1'>

            <?php if (isset($_SESSION['aluno_disciplina'])): ?>
                <tr><th colspan="7" class="centralizado">Aluno</th></tr>
                <tr>
                    <td>Matricula</td>
                    <td><input size="4" readonly value="<?php echo $_SESSION['aluno_disciplina']['aluno']; ?>"></td>
                    <td>Aluno</td>
                    <td><input readonly value="<?php echo $_SESSION['alunos'][$_SESSION['aluno_disciplina']['aluno']]['nome']; ?>"></td>
                    <td>Email</td>
                    <td><input readonly value="<?php echo $_SESSION['alunos'][$_SESSION['aluno_disciplina']['aluno']]['email']; ?>"></td>
                </tr>
                <tr><th colspan="7" class="centralizado">Disciplinas</th></tr>
                <?php foreach ($_SESSION['aluno_disciplina']['disciplina'] as $codigo): ?>
                    <tr>

                        <td>Codigo</td>
                        <td><input size="4" name="" readonly value="<?php echo $codigo; ?>"></td>
                        <td>Disciplina</td>
                        <td><input readonly name="" value="<?php echo $_SESSION['disciplinas'][$codigo]['nome'] ?>"></td>
                        <td>Carga Horária</td>
                        <td><input class="centralizado" readonly name="" value="<?php echo $_SESSION['disciplinas'][$codigo]['carga_horaria'] ?>"></td>
                        <td> 
                            <form action="../controller/MatriculaController.php" method="post">
                                <input type="hidden" name="disciplina_deletar" value="<?php echo $codigo; ?>">
                                <input type="hidden" name="apagar" value="apagar">
                                <button>remover</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr><th colspan="7" class="centralizado">Turmas</th></tr>
                        <?php foreach ($_SESSION['aluno_disciplina']['turmas'] as $codigo): ?>
                    <tr>
                        <td>Codigo</td>
                        <td><input size="4" name="" readonly value="<?php echo $codigo; ?>"></td>
                        <td>Turma</td>
                        <td colspan="3"><input size="52" readonly name="" value="<?php echo $_SESSION['turmas'][$codigo]['nome'] ?>"></td>
                        <td> 
                            <form action="../controller/MatriculaController.php" method="post">
                                <input type="hidden" name="turma_deletar" value="<?php echo $codigo; ?>">
                                <input type="hidden" name="apagar_turma" value="apagar_turma">
                                <button>remover</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="6"></td>
                    <td>
                        <form action="../controller/RealizaMatricula.php" method="post">
                            <!--pega a sessao aluno_disciplina e faz a matricula-->
                            <button>Efutuar Maricula</button></td>
                    </form>
                </tr>
            <?php endif; ?>
        </table>        
</html>

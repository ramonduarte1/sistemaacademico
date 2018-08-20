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
                var nome;
                nome = document.getElementById('buscar').value;
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
                var nome;
                nome = document.getElementById('buscar_disciplina').value;
                $.ajax({
                    type: "POST",
                    url: "../Consultas/matricularDisciplina.php",
                    data: 'pesq_disciplina=' + nome,
                    success: function (data) {
                        $('#disciplinas').html(data);

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
        </table>
</html>

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
        <script language="JavaScript" src="../js/mascaras.js"></script>
        <script type="text/javascript">
            function consultaAluno() {
                if ($("#pesq_aluno").val() == "") {
                    alert('Por favor, preencha o campo');
                    return false
                }
                var pesq_aluno = $("#pesq_aluno").val();
                var checkbox = $("input[name='radio']:checked").val();

                $.ajax({
                    type: "POST",
                    url: "../Consultas/consultaAlunos.php",
                    data: {pesq_aluno: pesq_aluno, checkbox: checkbox},
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
                <th>Pesquisa por Nome</th>
                <td>
                    <input required="" type="text" size="50" id="pesq_aluno" name="pesq_aluno">
                </td>
                <td>
                    <button onclick="consultaAluno()">Pesquisar</button>
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="esquerda">
                    <input type="radio" id="radio" value="1" name="radio"> Pesquisar apenas alunos matriculados
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="esquerda">
                    <input type="radio" id="radio" value="2" name="radio" checked> Pesquisar apenas alunos não matriculado
                </td>
            </tr>
        </tr>
    </tr>
</table>
<br><br>
<div class="centralizado" id="tabelaAluno"></div>
</body>
</html>

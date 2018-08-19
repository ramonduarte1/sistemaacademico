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
            function consultaDisciplina() {

                $.ajax({
                    type: "POST",
                    url: "../Consultas/consultaDisciplinas.php",
                    data: 'pesq_disciplina=' + $('#pesq_disciplina').val(),
                    success: function (data) {
                        $('#tabelaDisciplina').html(data);

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
        <h2 class="centralizado">Pesquisar Disciplinas</h2><br><br>
        <table border="0">
            <tr>
                <td>Pesquisa por Nome : </td>
                <td>
                    <input required="" type="text" size="50" id="pesq_disciplina" name="pesq_disciplina">
                </td>
                <td>
                    <button onclick="consultaDisciplina()">Pesquisar</button>
                </td>
            </tr>
        </table>
        <br><br>
        <div id="tabelaDisciplina" class="centralizado"></div>
</html>

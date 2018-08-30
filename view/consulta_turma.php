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
            function consultaTurmas() {
                if ($("#pesq_turma").val() == "") {
                    alert('Por favor, preencha o campo');
                    return false
                }
                $.ajax({
                    type: "POST",
                    url: "../Consultas/consultaTurmas.php",
                    data: 'pesq_turma=' + $('#pesq_turma').val(),
                    success: function (data) {
                        $('#tabelaTurma').html(data);

                    }
                });
            }
        </script>
    </head>
    <body>
        <?php
        session_start();
        if ((!isset($_SESSION['login']) == true) and ( !isset($_SESSION['senha']) == true)) {
            unset($_SESSION['login']);
            unset($_SESSION['senha']);
            echo "<script>alert('Area restrita!');location.href=\"../index.php\"</script> ";
        }
        $logado = $_SESSION['login'];
        
        include 'menu.php';
        ?>
        <h2 class="centralizado">Pesquisar Turma</h2><br><br>
        <table border="0">
            <tr>
                <th>Pesquisa por Nome</th>
                <td>
                    <input required="" type="text" size="50" id="pesq_turma" name="pesq_turma">
                </td>
                <td>
                    <button onclick="consultaTurmas()">Pesquisar</button>
                </td>
            </tr>
        </table>
        <br><br>
        <div id="tabelaTurma" class="centralizado"></div>

    </table>
</html>

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
            function consultaProfessor() {
                if ($("#pesq_professor").val() == "") {
                    alert('Por favor, preencha o campo');
                    return false
                }
                $.ajax({
                    type: "POST",
                    url: "../Consultas/consultaProfessores.php",
                    data: 'pesq_professor=' + $('#pesq_professor').val(),
                    success: function (data) {
                        $('#tabelaProfessor').html(data);

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
        <h2 class="centralizado">Pesquisar Professor</h2><br><br>
        <table border="0">
            <tr>
                <th>Pesquisa por Nome </th>
                <td>
                    <input required="" type="text" size="50" id="pesq_professor" name="pesq_professor">
                </td>
                <td>
                    <button onclick="consultaProfessor()">Pesquisar</button>
                </td>
            </tr>
        </table>
        <br><br>
        <div  id="tabelaProfessor" class="centralizado"></div>

</html>

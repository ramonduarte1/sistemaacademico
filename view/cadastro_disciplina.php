<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/css.css" >
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        session_start();
        if (!isset($_SESSION['matricula'])) {
            require_once '../controller/NumeroMatriculaController.php';
        }
        include 'menu.php';
        ?>
        <h2 class="centralizado">Cadastro Disciplina</h2><br><br>
        <form action="../controller/DisciplinaController.php" method="post">
            <table>
                <tr>
                    <td class="direita">Matricula</td>
                    <td><input readonly="" name="matricula" value="<?php echo $_SESSION['matricula'] ?>" size="4"></td>
                </tr>
                <tr>
                    <td class="direita">Nome</td>
                    <td>
                        <input type="text" required name="nome" size="50">
                    </td>
                </tr>
                <tr>
                    <td class="direita">Carga Horária</td>
                    <td><input type="text" required name="carga_horaria" size="10"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button>salvar</button>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>

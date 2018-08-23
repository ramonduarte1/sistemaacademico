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
       
            <table>
                <form name="salvar" action="../controller/DisciplinaController.php" method="post">
                    <tr>
                        <td class="direita">Matricula</td>
                        <td><input readonly="" name="matricula" value="<?php echo $_SESSION['matricula'] ?>" size="4"></td>
                    </tr>
                    <tr>
                        <td class="direita">Nome</td>
                        <td>
                            <input type="text" required name="nome" size="50">
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="direita">Carga Horária</td>
                        <td><input type="text" required name="carga_horaria" size="10"></td>
                        <td></td>
                    </tr>
                </form>
                <form>
                    <tr>
                    <td class="direita">Professor</td>
                    <td colspan="2"><input type="text" required name="professor" size="50"></td>
                    <td><button>buscar</button></td>
                </tr>

                </form>
                                <tr>
                    <td></td>
                    <td>
                        <button onclick="document.salvar.submit()">salvar</button>
                    </td>
                    <td></td>
                </tr>
            </table>
      
    </body>
</html>

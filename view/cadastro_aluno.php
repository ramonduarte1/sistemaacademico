<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <link rel="stylesheet" type="text/css"  href="css/css.css" />
        <meta charset="UTF-8">
        <title></title>
        <script language="JavaScript" src="../js/mascaras.js"></script>
    </head>
    <body>
        <?php
        session_start();
        if (!isset($_SESSION['matricula'])) {
            require_once '../controller/NumeroMatriculaController.php';
        }
        include 'menu.php';
        ?>
        <h2 class="centralizado">Cadastro Aluno</h2><br><br>

        <form action="../controller/AlunoController.php" method="post">
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
                    <td class="direita">Email</td>
                    <td><input type="email" required name="email" size="50"></td>
                </tr>
                <tr>
                    <td class="direita">Endereço</td>
                    <td><input type="text" required name="endereco" size="50"></td>
                </tr>
                <tr>
                    <td class="direita">Telefone</td>
                    <td><input type="text" name="telefone" onkeypress="mascara(this, '## #####-####')" maxlength="13"></td>
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

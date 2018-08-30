<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="view/css/css.css">
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div class="container">
            <div class="box"><br>
                <form action="controller/UsuarioController.php" method="post">
                    <table class="logincentro">
                        <tr>
                            <td>Usuario</td>
                        </tr>
                        <tr>
                            <td><input name="login" type="text" size="20"></td>
                        </tr>
                        <tr>
                            <td>Senha</td>
                        </tr>
                        <tr>
                            <td><input name="senha" type="password" size="20"></td>
                        </tr>
                        <tr>
                            <td><button>Entrar</button></td>
                        </tr>
                        <tr>
                            <td><a href="#" class="centralizado"> Esqueceu a senha?</a></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>

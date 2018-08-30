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
    </head>
    <body>
        <?php
        /* esse bloco de código em php verifica se existe a sessão, pois o usuário pode
          simplesmente não fazer o login e digitar na barra de endereço do seu navegador
          o caminho para a página principal do site (sistema), burlando assim a obrigação de
          fazer um login, com isso se ele não estiver feito o login não será criado a session,
          então ao verificar que a session não existe a página redireciona o mesmo
          para a index.php. */
        session_start();
        if ((!isset($_SESSION['login']) == true) and ( !isset($_SESSION['senha']) == true)) {
            unset($_SESSION['login']);
            unset($_SESSION['senha']);
            echo "<script>alert('usuario ou senha invalida!');location.href=\"../index.php\"</script> ";
        }

        $logado = $_SESSION['login'];

        include 'menu.php';
        ?>
        <h2 class="centralizado">Inicio</h2><br><br>

    </body>
</html>

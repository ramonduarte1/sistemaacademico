<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        session_start();
        $_SESSION['alunos'][1]['matricula'] = 1;
        $_SESSION['alunos'][1]['nome'] = 'Ramon Medeiros Duarte';
        $_SESSION['alunos'][1]['email'] = 'ramonduarte1@hotmail.com';
        $_SESSION['alunos'][1]['endereco'] = 'av jose nilo padua fortes,1451';
        $_SESSION['alunos'][1]['telefone'] =   '86 99937-4968';
        ?>
    </body>
</html>

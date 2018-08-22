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
        // put your code here $_SESSION['alunos_matriculados'][$matricula]['disciplina'][$codigo] = $_SESSION['disciplinas'][$codigo]['nome'];
        foreach ($_SESSION['alunos_matriculados'] as $matAluno => $value) {
            echo 'key: '.$matAluno.'<br>';
            foreach ($_SESSION['alunos_matriculados'][$matAluno]['disciplina'] as $codigo=>$disciplina) {
                echo 'codigo da disciplina '.$codigo;
                
            }
        }
        ?>
    </body>
</html>

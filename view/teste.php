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
        if (isset($_SESSION['alunos_matriculados'])) {
            $flag = 0;
            foreach ($_SESSION['alunos_matriculados'] as $matAluno => $value) {
                echo 'matAluno: ' . $matAluno . '<br>';
                foreach ($_SESSION['alunos_matriculados'][$matAluno]['turma'] as $codigo => $turma) {
                    echo 'codigo ' . $codigo . '<br>';

//                    if ($codigo == $this->getCodigo()) {
//                        $flag++;
//                        echo "<script>alert('Disciplina não pode ser deletada!');window.setTimeout(\"history.back(-2)\", 0)</script> ";
//                    }
                }
            }
            if ($flag == 0) { // se nao entrou no if flag continua 0
//                unset($_SESSION['disciplinas'][$this->getCodigo()]);
//                require_once '../controller/NumeroMatriculaController.php';
//                echo "<script>alert('Disciplina deletada com sucesso!');window.setTimeout(\"history.back(-2)\", 0)</script> ";
            }
        }
        ?>
    </body>
</html>

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
foreach ($_SESSION['turmas'] as $matricula => $turma) {

    $codigoTurma = $_POST['codigo_turma'];
echo "codigo da turma post: ".$codigoTurma;
    $pattern = '/' . $pesquisa . '/'; //Padrão a ser encontrado na string $tags
    if (preg_match($pattern, $turma['nome'])) {
        if (isset($_SESSION['alunos_matriculados'])) {
            $flag = 0;
            foreach ($_SESSION['alunos_matriculados'] as $matAluno => $value) {

                foreach ($_SESSION['alunos_matriculados'][$matAluno]['turma'] as $codigo => $turma) {

                    if ($codigo == $codigoTurma) {
                        $flag++;
                        echo 'matAluno: ' . $matAluno . '<br>';
                        echo 'codigo ' . $codigo . '<br>';

//                        echo "<script>alert('Disciplina não pode ser deletada!');window.setTimeout(\"history.back(-2)\", 0)</script> ";
                    }
                }
            }
            if ($flag == 0) { // se nao entrou no if flag continua 0
//                unset($_SESSION['disciplinas'][$this->getCodigo()]);
//                require_once '../controller/NumeroMatriculaController.php';
//                echo "<script>alert('Disciplina deletada com sucesso!');window.setTimeout(\"history.back(-2)\", 0)</script> ";
            }
        }
    }
}
//ok
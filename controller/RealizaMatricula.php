<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class RealizaMatricula {

    function __construct() {
        if (!isset($_SESSION['alunos_matriculados'])) {
            session_start();
        }
        $this->efetuarMatricula();

        var_dump($_SESSION['alunos_matriculados']);
    }

    private function efetuarMatricula() {
        $matricula = $_SESSION['aluno_disciplina']['aluno'];

        $_SESSION['alunos_matriculados'][$matricula]['aluno']['nome'] = $_SESSION['alunos'][$matricula]['nome'];
        $_SESSION['alunos_matriculados'][$matricula]['aluno']['email'] = $_SESSION['alunos'][$matricula]['email'];
        $_SESSION['alunos_matriculados'][$matricula]['aluno']['endereco'] = $_SESSION['alunos'][$matricula]['endereco'];
        $_SESSION['alunos_matriculados'][$matricula]['aluno']['telefone'] = $_SESSION['alunos'][$matricula]['telefone'];

        foreach ($_SESSION['aluno_disciplina']['disciplina'] as $codigo) {
            $_SESSION['alunos_matriculados'][$matricula]['disciplina'][$codigo] = $_SESSION['disciplinas'][$codigo]['nome'];
        }
        foreach ($_SESSION['aluno_disciplina']['turmas'] as $codigo) {
            $_SESSION['alunos_matriculados'][$matricula]['turma'][$codigo] = $_SESSION['turmas'][$codigo]['nome'];
        }
        unset($_SESSION['aluno_disciplina']);
    }

}

new RealizaMatricula();

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MatriculaControle
 *
 * @author usuario
 */
require_once '../model/Aluno.php';
require_once '../model/Disciplina.php';
require_once '../model/Turma.php';

class MatriculaController {

    private $aluno;
    private $disciplinas;

    function __construct() {
        session_start();
        $this->aluno = new Aluno();
        $this->disciplinas = array();
        $this->incluir();
    }

    private function incluir() {
        if (isset($_POST['disciplina'])) {
            $_SESSION['aluno_disciplina']['disciplina'][$_POST['disciplina']] = $_POST['disciplina'];
        }
        if (isset($_POST['matricula'])) {
            $_SESSION['aluno_disciplina']['aluno'] = $_POST['matricula'];
        }
//$_SESSION['aluno_disciplina'][$this->aluno->getMatricula()]['disciplina'] = $_POST['codigo_disciplina'];
        var_dump($_SESSION['aluno_disciplina']);
    }

}

new MatriculaController();

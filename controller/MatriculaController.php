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
        if (isset($_POST['apagar_turma'])) {
            unset($_SESSION['aluno_disciplina']['turmas'][$_POST['turma_deletar']]);
            echo "<script>alert('Disciplina removida com sucesso!');window.setTimeout(\"history.back(-2)\", 0)</script> ";
        }
        if (isset($_POST['apagar'])) {
            unset($_SESSION['aluno_disciplina']['disciplina'][$_POST['disciplina_deletar']]);
            echo "<script>alert('Disciplina removida com sucesso!');window.setTimeout(\"history.back(-2)\", 0)</script> ";
        }
        if (isset($_POST['disciplina'])) {
            $_SESSION['aluno_disciplina']['disciplina'][$_POST['disciplina']] = $_POST['disciplina'];
            echo "<script>alert('Disciplina inserida com sucesso!');window.setTimeout(\"history.back(-2)\", 0)</script> ";
        }
        if (isset($_POST['turma'])) {
            $_SESSION['aluno_disciplina']['turmas'][$_POST['turma']] = $_POST['turma'];
            //var_dump($_SESSION['aluno_disciplina']);
            echo "<script>alert('Turma inserida com sucesso!');window.setTimeout(\"history.back(-2)\", 0)</script> ";
        }
        if (isset($_POST['matricula'])) {
            $_SESSION['aluno_disciplina']['aluno'] = $_POST['matricula'];
            echo "<script>alert('Aluno inserido com sucesso!');window.setTimeout(\"history.back(-2)\", 0)</script> ";
        }
    }

}

new MatriculaController();

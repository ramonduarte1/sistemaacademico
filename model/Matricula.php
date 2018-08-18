<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Matricula
 *
 * @author usuario
 */
require_once 'Aluno.php';
require_once 'Turma.php';
require_once 'Disciplina.php';

class Matricula {
    private $aluno;
    private $turmas;
    private $disciplinas;
    
    function __construct() {
        $this->turmas = array();
        $this->disciplinas = array();
        
    }
    function getAluno() {
        return $this->aluno;
    }

    function getTurmas() {
        return $this->turmas;
    }

    function getDisciplinas() {
        return $this->disciplinas;
    }

    function setAluno($aluno) {
        $this->aluno = $aluno;
    }

    function setTurmas($turmas) {
        $this->turmas = $turmas;
    }

    function setDisciplinas($disciplinas) {
        $this->disciplinas = $disciplinas;
    }


}

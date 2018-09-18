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
class Matricula {

    private $aluno;
    private $turma;

    function __construct() {
        $this->aluno = new Aluno();
        $this->turma = new Turma();

        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public function matriculaAluno($matricula) {
        $_SESSION['matricula']['aluno'] = $matricula;
        $this->aluno->setMatricula($matricula);

        return $this->aluno->retornaAluno();
    }

    public function codigoTurma($codigo) {
        $_SESSION['matricula']['turma'] = $codigo;
        $this->turma->setCodigo($codigo);
        return $this->turma->retornaTurma();
    }

    public function retornaAluno() {
        $this->aluno->setMatricula($_SESSION['matricula']['aluno']);
        return $this->aluno->retornaAluno();
    }
}

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
        $a = 1;
        return $this->aluno->retornaAluno();
    }

    public function salvar() {
        $this->aluno->setMatricula($_SESSION['matricula']['aluno']);
        $this->turma->setCodigo($_SESSION['matricula']['turma']);
        
        $sql = "UPDATE aluno SET turma_id = " . $this->turma->getCodigo() . ", usuario_altera = :usuario_altera, data_altera = :data_altera WHERE id =" . $this->aluno->getMatricula() . " ";
        $insert = $this->conexao->prepare($sql);
        
        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d H:i');

        $bind = array(
            ':usuario_altera' => $_SESSION['login'],
            ':data_altera' => $date
        );
        $insert->execute($bind);

        if ($insert != FALSE) {
            return "Sucesso!";
        } else {
            return "Ocorreu um erro!";
        }
    }

}

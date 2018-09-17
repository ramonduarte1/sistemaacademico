<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AlunoController
 *
 * @author ramon
 */
class AlunoController {

    private $aluno;
    private $objResponse;

    function __construct() {
        $aluno = new Aluno();
        $this->objResponse = new xajaxResponse(); //instancia o xajax
    }

    public function pesquisaAluno($form) {
        $aluno = new Aluno();
        $result = $aluno->retornaAlunos($form['radio'], $form['pesq_aluno']);

        $this->objResponse->alert($result);
        return $this->objResponse;
    }

    public function salvarAluno($form) {
        $this->aluno = new Aluno();
        $this->aluno->setNome($form['nome']);
        $this->aluno->setTelefone($form['telefone']);
        $this->aluno->setEmail($form['email']);
        $this->aluno->setEndereco($form['endereco']);

        $this->objResponse->script($this->aluno->salvaNoBanco());

        return $this->objResponse;
    }

    public function adicionarTurma($form) {
        $this->aluno = new Aluno();
        $this->aluno->setMatricula($_SESSION['matricula']['aluno']);
        $this->aluno->setTurma_id($_SESSION['matricula']['turma']);
        $this->objResponse->alert($this->aluno->adicionarTurma());

        return $this->objResponse;
    }

    public function atualizarAluno($form) {

        $this->aluno = new Aluno();
        $this->aluno->setMatricula($form['matricula']);
        $this->aluno->setNome($form['nome']);
        $this->aluno->setTelefone($form['telefone']);
        $this->aluno->setEmail($form['email']);
        $this->aluno->setEndereco($form['endereco']);
        $this->aluno->setTrancado($form['trancar']);
        $this->aluno->setDisciplinas($form['disciplinas']);

        $result = $this->aluno->atualizar();

        $this->objResponse->alert($result);
        return $this->objResponse;
    }

    public function removerTurma($form) {
      
        $this->aluno = new Aluno();
        $this->aluno->setMatricula($form['matricula']);
        
        $this->objResponse->alert($this->aluno->removerTurma());
        return $this->objResponse;
    }

    public function apagarAluno($form) {

        $this->aluno = new Aluno();
        $this->aluno->setMatricula($form['matricula']);

        $this->objResponse->script($this->aluno->apagar());
        return $this->objResponse;
    }

}

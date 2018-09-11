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
class ProfessorController {

    private $professor;
    private $objResponse;
    private $disciplinas;

    function __construct() {
        $this->objResponse = new xajaxResponse(); //instancia o xajax
        $this->disciplinas = array();
    }

    public function pesquisaProfessor($form) {
        $professor = new Professor();
        $result = $professor->retornaProfessores($form['radio'], $form['pesq_professor']);

        $this->objResponse->alert($result);
        return $this->objResponse;
    }

    public function salvarProfessor($form) {
        $this->disciplinas = $form['disciplinas'];
        
        $this->professor = new Professor();
        $this->professor->setDisciplinas($this->disciplinas);
        $this->professor->setNome($form['nome']);
        $this->professor->setTelefone($form['telefone']);
        $this->professor->setEmail($form['email']);
        $this->professor->setEndereco($form['endereco']);

        $result = $this->professor->salvaNoBanco();

        $this->objResponse->alert($result);
        return $this->objResponse;
    }

    public function atualizarProfessor($form) {

        $this->professor = new Professor();
        $this->professor->setMatricula($form['matricula']);
        $this->professor->setNome($form['nome']);
        $this->professor->setTelefone($form['telefone']);
        $this->professor->setEmail($form['email']);
        $this->professor->setEndereco($form['endereco']);

        $result = $this->professor->atualizar();

        $this->objResponse->alert($result);
        return $this->objResponse;
    }

    public function apagarProfessor($form) {

        $this->professor = new Professor();
        $this->professor->setMatricula($form['matricula']);

        $result = $this->professor->apagar();

        $this->objResponse->alert($result);
        return $this->objResponse;
    }

}

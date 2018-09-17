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

        $result = $this->professor->salvar();

        $this->objResponse->script($result);
        return $this->objResponse;
    }

    public function atualizarProfessor($form) {
        
        $disciplinas = array();
        foreach ($form['disciplinas'] as $id) {
            array_push($disciplinas, $id);
        }
        
        $this->professor = new Professor();
        $this->professor->setMatricula($form['matricula']);
        $this->professor->setNome($form['nome']);
        $this->professor->setTelefone($form['telefone']);
        $this->professor->setEmail($form['email']);
        $this->professor->setEndereco($form['endereco']);
        $this->professor->setDisciplinas($disciplinas);


        $result = $this->professor->atualizar();

        $this->objResponse->script($result);
        return $this->objResponse;
    }

    public function apagarProfessor($form) {

        $this->professor = new Professor();
        $this->professor->setMatricula($form['matricula']);

        $this->objResponse->script($this->professor->apagar());
        return $this->objResponse;
    }

}

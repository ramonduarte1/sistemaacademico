<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TurmaController
 *
 * @author usuario
 */
class TurmaController {

    private $turma;
    private $objResponse;

    function __construct() {
        $this->objResponse = new xajaxResponse(); //instancia o xajax
    }

    public function pesquisaTurma($form) {
        $turma = new Turma();
        $result = $turma->retornaTurmas($form['radio'], $form['pesq_turma']);

        $this->objResponse->alert($result);
        return $this->objResponse;
    }

    public function salvarTurma($form) {

        $this->turma = new Turma();
        $this->turma->setNome($form['nome']);

        $disciplinas = array();

        foreach ($form['disciplinas'] as $id) {
            array_push($disciplinas, $id);
        }

        $this->turma->setDisciplinas($disciplinas);
        $result = $this->turma->salvar();

        $this->objResponse->script($result);
        
        return $this->objResponse;
    }

    public function atualizarTurma($form) {

        $this->turma = new Turma();
        $this->turma->setCodigo($form['matricula']);
        $this->turma->setNome($form['nome']);
        
        $disciplinas = array();
        foreach ($form['disciplinas'] as $id) {
            array_push($disciplinas, $id);
        }

        $this->turma->setDisciplinas($disciplinas);
        $this->objResponse->script($this->turma->atualizar());
        return $this->objResponse;
    }

    public function apagarTurma($form) {

        $this->turma = new Turma();
        $this->turma->setCodigo($form['matricula']);

        $this->objResponse->script($this->turma->apagar());
        return $this->objResponse;
    }

}

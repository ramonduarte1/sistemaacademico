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
        if (!isset($_SESSION)) {
            session_start();
        }
        $this->objResponse = new xajaxResponse(); //instancia o xajax
    }

    public function pesquisaTurma($form) {
        $turma = new Turma();
        $result = $turma->retornaTurmas($form['radio'], $form['pesq_turma']);

        $this->objResponse->alert($result);
        return $this->objResponse;
    }

//
//    public function salvarTurma($form) {
//
//        $this->turma = new Turma();
//        $this->turma->setNome($form['nome']);
//
//        $result = $this->turma->salvarNoBanco();
//
//        $this->objResponse->alert($result);
//        return $this->objResponse;
//    }

    public function salvarTurma($form) {

        $this->turma = new Turma();
        $this->turma->setNome($form['nome']);

        $disciplinas = array();

        foreach ($form['disciplinas'] as $id) {
            array_push($disciplinas, $id);
        }

        $this->turma->setDisciplinas($disciplinas);
        $result = $this->turma->salvarNoBanco();

        $this->objResponse->alert($result);
        $this->objResponse->clear('formTurma', 'reset');
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

        $result = $this->turma->atualizar();

        $this->objResponse->alert($result);
        return $this->objResponse;
    }

    public function apagarTurma($form) {

        $this->turma = new Turma();
        $this->turma->setCodigo($form['matricula']);

        $result = $this->turma->apagar();

        $this->objResponse->alert($result);
        return $this->objResponse;
    }

}

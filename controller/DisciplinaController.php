<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DisciplinaController
 *
 * @author usuario
 */
class DisciplinaController {

    private $discplina;
    private $objResponse;

    function __construct() {
        if (!isset($_SESSION)) {
            session_start();
        }

        $this->objResponse = new xajaxResponse(); //instancia o xajax
    }

    public function pesquisaDisciplina($form) {
        $disciplina = new Disciplina();
        $result = $disciplina->retornaDisciplinas($form['radio'], $form['pesq_disciplina']);

        $this->objResponse->alert($result);
        return $this->objResponse;
    }

    public function salvarDisciplina($form) {

        $this->discplina = new Disciplina();
        $this->discplina->setNome($form['nome']);
        $this->discplina->setCargaHoraria($form['carga_horaria']);

        $result = $this->discplina->salvarNoBanco();

        $this->objResponse->script($result);
        return $this->objResponse;
    }

    public function atualizarDisciplina($form) {

        $this->discplina = new Disciplina();
        $this->discplina->setCodigo($form['matricula']);
        $this->discplina->setNome($form['nome']);
        $this->discplina->setCargaHoraria($form['carga_horaria']);

        $result = $this->discplina->atualizar();

        $this->objResponse->alert($result);
        return $this->objResponse;
    }

    public function apagarDisciplina($form) {

        $this->discplina = new Disciplina();
        $this->discplina->setCodigo($form['matricula']);

        $result = $this->discplina->apagar();

        $this->objResponse->alert($result);
        return $this->objResponse;
    }

}

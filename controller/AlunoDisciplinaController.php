<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AlunoDisciplinaController {

    private $objResponse;
    private $alunoDisciplina;

    function __construct() {
        $this->objResponse = new xajaxResponse(); //instancia o xajax
        $this->alunoDisciplina = new AlunoDisciplina();
    }

    public function salvaNotas($form) {
        $this->alunoDisciplina->setForm($form);
        $this->objResponse->script($this->alunoDisciplina->incluirNotas());
        return $this->objResponse;
    }

}

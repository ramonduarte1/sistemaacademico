<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MatriculaControle
 *
 * @author usuario
 */
class MatriculaController {

    private $matricula;
    private $objResponse;

    function __construct() {
        $this->objResponse = new xajaxResponse(); //instancia o xajax
    }

    public function salvarTurmaAluno($form) {

        $this->matricula = new Matricula();
        $retorno =$this->matricula->salvar();
        $this->objResponse->alert($retorno);
        return $this->objResponse;
    }

}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class XajaxUtil {

    private $xajax;
    private $xajax_js;

    function __construct() {
        $this->xajax = new xajax();
        $this->xajax->configureMany(array("debug" => false, "javascript URI" => "/lib", "statusMessages" => true, "waitCursor" => true, "errorHandler" => true));
        //registra funcoes
        $this->xajax->register(XAJAX_FUNCTION, 'exibeLogin');
        $this->xajax->register(XAJAX_FUNCTION, 'menuPrincipal');
        $this->xajax->register(XAJAX_FUNCTION, 'menuAluno');
        $this->xajax->register(XAJAX_FUNCTION, 'menuProfessor');

        //registra metodos
        $login = new UsuarioController();
        $this->xajax->register(XAJAX_FUNCTION, array("verificaCredenciais", $login, "verificaCredenciais")); //metodo

        $aluno = new AlunoController();
        $this->xajax->register(XAJAX_FUNCTION, array("salvarAluno", $aluno, "salvarAluno"));
        $this->xajax->register(XAJAX_FUNCTION, array("pesquisaAluno", $aluno, "pesquisaAluno"));
        $this->xajax->register(XAJAX_FUNCTION, array("apagarAluno", $aluno, "apagarAluno"));
        $this->xajax->register(XAJAX_FUNCTION, array("atualizarAluno", $aluno, "atualizarAluno"));

        $professor = new ProfessorController();
        $this->xajax->register(XAJAX_FUNCTION, array("salvarProfessor", $professor, "salvarProfessor"));
        $this->xajax->register(XAJAX_FUNCTION, array("pesquisaProfessor", $professor, "pesquisaProfessor"));
        $this->xajax->register(XAJAX_FUNCTION, array("apagarProfessor", $professor, "apagarProfessor"));
        $this->xajax->register(XAJAX_FUNCTION, array("atualizarProfessor", $professor, "atualizarProfessor"));

        $this->xajax->processRequest();
        $this->xajax_js = $this->xajax->getJavascript("./lib");
    }

    function getXajax_js() {
        return $this->xajax_js;
    }

    function setXajax_js($xajax_js) {
        $this->xajax_js = $xajax_js;
    }

}

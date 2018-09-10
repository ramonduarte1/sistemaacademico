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
        $this->xajax->register(XAJAX_FUNCTION, 'menuDisciplina');
        $this->xajax->register(XAJAX_FUNCTION, 'menuTurma');
        $this->xajax->register(XAJAX_FUNCTION, 'menuLancaNota');
        $this->xajax->register(XAJAX_FUNCTION, 'menuMatricula');
        $this->xajax->register(XAJAX_FUNCTION, 'menuRelatorio');

        //registra metodos
        $login = new UsuarioController();
        $this->xajax->register(XAJAX_FUNCTION, array("verificaCredenciais", $login, "verificaCredenciais")); //metodo
        $this->xajax->register(XAJAX_FUNCTION, array("sair", $login, "sair")); //metodo

        $aluno = new AlunoController();
        $this->xajax->register(XAJAX_FUNCTION, array("salvarAluno", $aluno, "salvarAluno"));
        $this->xajax->register(XAJAX_FUNCTION, array("pesquisaAluno", $aluno, "pesquisaAluno"));
        $this->xajax->register(XAJAX_FUNCTION, array("apagarAluno", $aluno, "apagarAluno"));
        $this->xajax->register(XAJAX_FUNCTION, array("atualizarAluno", $aluno, "atualizarAluno"));
        $this->xajax->register(XAJAX_FUNCTION, array("adicionarTurma", $aluno, "adicionarTurma"));

        $professor = new ProfessorController();
        $this->xajax->register(XAJAX_FUNCTION, array("salvarProfessor", $professor, "salvarProfessor"));
        $this->xajax->register(XAJAX_FUNCTION, array("pesquisaProfessor", $professor, "pesquisaProfessor"));
        $this->xajax->register(XAJAX_FUNCTION, array("apagarProfessor", $professor, "apagarProfessor"));
        $this->xajax->register(XAJAX_FUNCTION, array("atualizarProfessor", $professor, "atualizarProfessor"));

        $disciplina = new DisciplinaController();
        $this->xajax->register(XAJAX_FUNCTION, array("salvarDisciplina", $disciplina, "salvarDisciplina"));
        $this->xajax->register(XAJAX_FUNCTION, array("pesquisarDisciplina", $disciplina, "pesquisarDisciplina"));
        $this->xajax->register(XAJAX_FUNCTION, array("apagarDisciplina", $disciplina, "apagarDisciplina"));
        $this->xajax->register(XAJAX_FUNCTION, array("atualizarDisciplina", $disciplina, "atualizarDisciplina"));

        $turma = new TurmaController();
        $this->xajax->register(XAJAX_FUNCTION, array("salvarTurma", $turma, "salvarTurma"));
        $this->xajax->register(XAJAX_FUNCTION, array("pesquisarTurma", $turma, "pesquisarTurma"));
        $this->xajax->register(XAJAX_FUNCTION, array("apagarTurma", $turma, "apagarTurma"));
        $this->xajax->register(XAJAX_FUNCTION, array("atualizarTurma", $turma, "atualizarTurma"));

        $alunoDisciplina = new AlunoDisciplinaController();
        $this->xajax->register(XAJAX_FUNCTION, array("incluirNotas", $alunoDisciplina, "incluirNotas"));


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

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
require_once '../autoload.php';

class AlunoController {

    private $aluno;
    private $acao;
    
    function __construct() {
        if (!isset($_SESSION)) {
            session_start();
        }
        $this->aluno = new Aluno();
        $this->incluir();

        if($this->acao == 'atualizar'){
            $this->aluno->atualizar();
        }elseif ($this->acao === 'apagar') {
            $this->aluno->apagar();
        } else {
            $this->aluno->cadastrar();
        }
    }

    private function incluir() {
        $this->aluno->setMatricula($_POST['matricula']);
        $this->aluno->setNome($_POST['nome']);
        $this->aluno->setEmail($_POST['email']);
        $this->aluno->setEndereco($_POST['endereco']);
        $this->aluno->setTelefone($_POST['telefone']);
        //$this->aluno->setTurma_id($_POST['turma_id']);

        if (isset($_POST['apagar'])) {
            $this->acao = $_POST['apagar'];
        }
        if (isset($_POST['atualizar'])) {
            $this->acao = $_POST['atualizar'];
        }
    }

}

new AlunoController();

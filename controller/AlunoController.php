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
require_once '../model/Aluno.php';

class AlunoController {

    private $aluno;

    function __construct() {
        session_start();
        $this->aluno = new Aluno();
        $this->incluir();
        $this->aluno->cadastrar();
    }
    

    private function incluir() {
        $this->aluno->setMatricula($_POST['matricula']);
        $this->aluno->setNome($_POST['nome']);
        $this->aluno->setEmail($_POST['email']);
        $this->aluno->setEndereco($_POST['endereco']);
        $this->aluno->setTelefone($_POST['telefone']);
    }

}

new AlunoController();

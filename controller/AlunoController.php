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
    private $apagar;

    function __construct() {
        if (!isset($_SESSION)) {
            session_start();
        }
        $this->aluno = new Aluno();
        $this->incluir();

        if ($this->apagar === 'apagar') {
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
        
        if (isset($_POST['apagar'])) {
            $this->apagar = $_POST['apagar'];
        }
    }

}

new AlunoController();

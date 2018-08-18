<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Professor
 *
 * @author ramon
 */
require_once '../model/Pessoa.php';

class Professor extends Pessoa {

    function __construct() {
        if (!session_status()) {
            session_start();
        }
    }

    public function cadastrar() {
        $_SESSION['professores'][$this->getMatricula()]['matricula'] = $this->getMatricula();
        $_SESSION['professores'][$this->getMatricula()]['nome'] = $this->getNome();
        $_SESSION['professores'][$this->getMatricula()]['email'] = $this->getEmail();
        $_SESSION['professores'][$this->getMatricula()]['endereco'] = $this->getEndereco();
        $_SESSION['professores'][$this->getMatricula()]['telefone'] = $this->getTelefone();
        //array_push($_SESSION['alunos'][$this->getMatricula()]['notas'], $this->getNotas());
        var_dump($_SESSION);
        require_once '../controller/NumeroMatriculaController.php';
    }

}

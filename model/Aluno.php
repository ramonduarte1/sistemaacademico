<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Aluno
 *
 * @author ramon
 */
require_once '../model/Pessoa.php';

class Aluno extends Pessoa {

    private $notas;

    function __construct() {
        if (!session_status()) {
            session_start();
        }
        $this->notas = array();
    }

    function getNotas() {
        return $this->notas;
    }

    function setNotas($notas) {
        $this->notas = $notas;
    }

    public function cadastrar() {

        $_SESSION['alunos'][$this->getMatricula()]['matricula'] = $this->getMatricula();
        $_SESSION['alunos'][$this->getMatricula()]['nome'] = $this->getNome();
        $_SESSION['alunos'][$this->getMatricula()]['email'] = $this->getEmail();
        $_SESSION['alunos'][$this->getMatricula()]['endereco'] = $this->getEndereco();
        $_SESSION['alunos'][$this->getMatricula()]['telefone'] = $this->getTelefone();
        //array_push($_SESSION['alunos'][$this->getMatricula()]['notas'], $this->getNotas());
        //var_dump($_SESSION['alunos']);
        require_once '../controller/NumeroMatriculaController.php';
    }

    public function apagar() {
        unset($_SESSION['alunos'][$this->getMatricula()]);
        require_once '../controller/NumeroMatriculaController.php';
    }

    public function incluirNotas() {
        
    }

}

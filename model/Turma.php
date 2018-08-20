<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Turma
 *
 * @author usuario
 */
class Turma {

    private $codigo;
    private $nome;

    function __construct() {
        if (!isset($_SESSION['turmas'])) {
            session_start();
        }
    }

    function getCodigo() {
        return $this->codigo;
    }

    function getNome() {
        return $this->nome;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    public function cadastrar() {
        $_SESSION['turmas'][$this->getCodigo()]['codigo'] = $this->getCodigo();
        $_SESSION['turmas'][$this->getCodigo()]['nome'] = $this->getNome();
        var_dump($_SESSION);

        require_once '../controller/NumeroMatriculaController.php';
    }

    public function apagar() {
        unset($_SESSION['turmas'][$this->getCodigo()]);
        require_once '../controller/NumeroMatriculaController.php';
    }

}

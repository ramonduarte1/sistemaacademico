<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Disciplina
 *
 * @author ramon
 */
class Disciplina {

    private $codigo;
    private $nome;
    private $cargaHoraria;

    function __construct() {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    function getCargaHoraria() {
        return $this->cargaHoraria;
    }

    function setCargaHoraria($cargaHoraria) {
        $this->cargaHoraria = $cargaHoraria;
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
        $_SESSION['disciplinas'][$this->getCodigo()]['codigo'] = $this->getCodigo();
        $_SESSION['disciplinas'][$this->getCodigo()]['nome'] = $this->getNome();
        $_SESSION['disciplinas'][$this->getCodigo()]['carga_horaria'] = $this->getCargaHoraria();
        //var_dump($_SESSION['disciplinas']);

        require_once '../controller/NumeroMatriculaController.php';
    }

    public function apagar() {
        unset($_SESSION['disciplinas'][$this->setCodigo($codigo)]);
        require_once '../controller/NumeroMatriculaController.php';
    }

}

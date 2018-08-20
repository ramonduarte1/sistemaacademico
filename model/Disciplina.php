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
    private $nota1;
    private $nota2;
    private $nota3;

    function __construct() {
        if (!isset($_SESSION)) {
            session_start();
        }
    }
    function getNota1() {
        return $this->nota1;
    }

    function getNota2() {
        return $this->nota2;
    }

    function getNota3() {
        return $this->nota3;
    }

    function setNota1($nota1) {
        $this->nota1 = $nota1;
    }

    function setNota2($nota2) {
        $this->nota2 = $nota2;
    }

    function setNota3($nota3) {
        $this->nota3 = $nota3;
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
        unset($_SESSION['disciplinas'][$this->getCodigo()]);
        require_once '../controller/NumeroMatriculaController.php';
    }

}

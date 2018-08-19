<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProfessorController
 *
 * @author ramon
 */
require_once '../model/Professor.php';

class ProfessorController {

    private $professor;
    private $apagar;

    function __construct() {
        if (!isset($_SESSION)) {
            session_start();
        }

        $this->professor = new Professor();
        $this->incluir();
        if ($this->apagar === 'apagar') {
            $this->professor->apagar();
        } else {
            $this->professor->cadastrar();
        }
    }

    private function incluir() {
        $this->professor->setMatricula($_POST['matricula']);
        $this->professor->setNome($_POST['nome']);
        $this->professor->setEmail($_POST['email']);
        $this->professor->setEndereco($_POST['endereco']);
        $this->professor->setTelefone($_POST['telefone']);

        if (isset($_POST['apagar'])) {
            $this->apagar = $_POST['apagar'];
        }
        
    }

}

new ProfessorController();

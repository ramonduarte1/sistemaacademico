<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TurmaController
 *
 * @author usuario
 */
require_once '../model/Turma.php';

class TurmaController {

    private $turma;
    private $apagar;

    function __construct() {
        if (!isset($_SESSION['turmas'])) {
            session_start();
        }
        $this->turma = new Turma();
        $this->incluir();
        if ($this->apagar === 'apagar') {
            $this->turma->apagar();
            echo "<script>alert('Turma apagado com sucesso!');window.setTimeout(\"history.back(-2)\", 0)</script> ";
        } else {
            $this->turma->cadastrar();
            echo "<script>alert('Turma cadastrado com sucesso!');window.setTimeout(\"history.back(-2)\", 0)</script> ";
        }
    }

    private function incluir() {
        $this->turma->setCodigo($_POST['matricula']);
        $this->turma->setNome($_POST['nome']);
        if (isset($_POST['apagar'])) {
            $this->apagar = $_POST['apagar'];
        }
    }

}

new TurmaController();

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
            
        } else {
            $this->turma->cadastrar();
            echo "<script>alert('Turma cadastrado com sucesso!');location.href=\"../view/consulta_turma.php\"</script> ";
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

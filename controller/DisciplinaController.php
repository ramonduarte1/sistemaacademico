<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DisciplinaController
 *
 * @author usuario
 */
require_once '../autoload.php'; //require_once '../model/Disciplina.php';

class DisciplinaController {

    private $discplina;
    private $acao;

    function __construct() {
        if (!isset($_SESSION)) {
            session_start();
        }
        $this->discplina = new Disciplina();
        $this->incluir();
        
        if ($this->acao === 'atualizar') {
            $this->discplina->atualizar();
        }else if ($this->acao === 'apagar') {
            $this->discplina->apagar();
        } else {
            $this->discplina->cadastrar();
        }
    }

    private function incluir() {
        $this->discplina->setCodigo($_POST['matricula']);
        $this->discplina->setNome($_POST['nome']);
        $this->discplina->setCargaHoraria($_POST['carga_horaria']);
        $this->discplina->setUsuarioAltera($_SESSION['login']);

        if (isset($_POST['apagar'])) {
            $this->acao = $_POST['apagar'];
        }
        if (isset($_POST['atualizar'])) {
            $this->acao = $_POST['atualizar'];
        }
    }

}

new DisciplinaController();

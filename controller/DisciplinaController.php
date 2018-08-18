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
require_once '../model/Disciplina.php';

class DisciplinaController {

    private $discplina;

    function __construct() {
        if (!isset($_SESSION['disciplinas'])) {
            session_start();
        }
        $this->discplina = new Disciplina();
        $this->incluir();
        $this->discplina->cadastrar();
    }

    private function incluir() {
        $this->discplina->setCodigo($_SESSION['matricula']);
        $this->discplina->setNome($_POST['nome']);
        $this->discplina->setCargaHoraria($_POST['carga_horaria']);
    }

}
new DisciplinaController();
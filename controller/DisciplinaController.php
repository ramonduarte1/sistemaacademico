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
    private $apagar;

    function __construct() {
        if (!isset($_SESSION)) {
            session_start();
        }
        $this->discplina = new Disciplina();
        $this->incluir();

        if ($this->apagar === 'apagar') {
            $this->discplina->apagar();
           
        } else {
            $this->discplina->cadastrar();
         
        }
        
    }

    private function incluir() {
        $this->discplina->setCodigo($_POST['matricula']);
        $this->discplina->setNome($_POST['nome']);
        $this->discplina->setCargaHoraria($_POST['carga_horaria']);

        if (isset($_POST['apagar'])) {
            $this->apagar = $_POST['apagar'];
        }
    }

}

new DisciplinaController();

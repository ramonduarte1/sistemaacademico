<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NumeroMatriculaController
 *
 * @author ramon
 */
class NumeroMatriculaController {
    function __construct() {
        session_start();
        if(!isset($_SESSION['matricula'])){
            $_SESSION['matricula'] = 0;
            
        }
        $this->geraMatricula();
        
    }
    private function geraMatricula(){
        $matricula  = $_SESSION['matricula'];
        $matricula += 1;
        $_SESSION['matricula'] = $matricula;
    }

}
new NumeroMatriculaController();
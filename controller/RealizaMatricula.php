<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../model/Aluno.php';
require_once '../model/Disciplina.php';
require_once '../model/Turma.php';

class RealizaMatricula{
    private $aluno;
    private $disciplinas;
    private $turmas;
    
    function __construct() {
        if(!isset($_SESSION)){session_start();}
        
        
    }

}

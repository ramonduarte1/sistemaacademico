<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AlunoController
 *
 * @author ramon
 */
require_once '../autoload.php';

class UsuarioController {

    private $usuario;

    function __construct() {
        if (!isset($_SESSION)) {
            session_start();
        }
        $this->usuario = new Usuario();
        $this->incluir();
        $this->usuario->verificaLogin();
    }

    private function incluir() {
        $this->usuario->setLogin($_POST['login']);
        $this->usuario->setSenha($_POST['senha']);
    }
    

}

new UsuarioController();

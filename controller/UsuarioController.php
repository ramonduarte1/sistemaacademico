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
class UsuarioController {

    private $usuario;
    private $objResponse;

    function __construct() {
        $this->objResponse = new xajaxResponse(); //instancia o xajax
    }

    public function verificaCredenciais($form) {

        $this->usuario = new Usuario();
        $this->usuario->setLogin($form['login']);
        $this->usuario->setSenha($form['senha']);
        if ($this->usuario->verificaLogin() == 0) {
            $this->objResponse->alert('usuario ou senha invalido');
        } else {
            $this->objResponse->call('xajax_menuPrincipal');
        }

        return $this->objResponse;
    }

    public function sair() {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);

        $this->objResponse->script("alert('Area restrita!');location.href=\"index.php\";");

        return $this->objResponse;
    }

}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author usuario
 */
class Usuario {

    private $id;
    private $login;
    private $senha;
    private $conexao;

    function __construct() {
        $this->conexao = new Conexao();
        if(isset($_SESSION)){
            session_start();
        }
    }

    function getId() {
        return $this->id;
    }

    function getLogin() {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    public function verificaLogin() {
        $sql = "select *from usuario where login = '" . $this->getLogin() . "' and senha = '" . $this->getSenha()."'";
        $consulta = $this->conexao->query($sql)->fetchAll();
 
        if (count($consulta) < 1) {
            return 0;
        } else {
            $_SESSION['login'] = $consulta[0]['login'];
            $_SESSION['senha'] = $consulta[0]['senha'];
                        
           return 1;
        }
    }
}
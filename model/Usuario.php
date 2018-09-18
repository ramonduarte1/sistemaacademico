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
        if (isset($_SESSION)) {
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
        $sql = "select *from usuario where login = '" . $this->getLogin() . "' and senha = '" . $this->getSenha() . "'";
        $consulta = $this->conexao->query($sql)->fetchAll();

        if (count($consulta) < 1) {
            return 0;
        } else {
            $_SESSION['login'] = $consulta[0]['login'];
            $_SESSION['senha'] = $consulta[0]['senha'];

            return 1;
        }
    }

    public function retornaUsuarios($tipo, $pesquisa) {
        if ($tipo == '1') {// usuario por nome
            $sql = "select *from usuario where login like '%$pesquisa%' and usuario.deletado = 'n' ORDER BY id ASC";
        }
        if ($tipo == '2') {// usuario por codigo
            $sql = "select *from usuario where id = " . $pesquisa . " and deletado = 'n'";
        }

        $array = array();
        $insert = $this->conexao->query($sql);
        foreach ($insert as $aluno) {
            array_push($array, $aluno);
        }

        return $array;
    }

    public function salvar() {
        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d H:i');

        $sql = "INSERT INTO usuario (login,senha,usuario_altera,data_altera) VALUES ('" . $this->getLogin() . "','" . $this->getSenha() . "','" . $_SESSION['login'] . "','" . $date . "')";
        $insert = $this->conexao->query($sql);

        if ($insert->rowCount() > 0) {
            return "alert('Usuario cadastrado com sucesso!');document.getElementById(\"formUsuario\").reset();";
        } else {
            return "alert('Ocorreu um erro ao cadastrar!')";
        }
    }

    public function apagar() {

        $sql = "UPDATE usuario SET deletado =:deletado, usuario_altera = :usuario_altera, data_altera= :data_altera WHERE id = :id";
        $insert = $this->conexao->prepare($sql);

        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d H:i');

        $bind = array(
            ':deletado' => 's',
            ':usuario_altera' => $_SESSION['login'],
            ':data_altera' => $date,
            ':id' => $this->getId()
        );
        $insert->execute($bind);

        if ($insert != FALSE) {
            $matricula = $this->getId();
            return 'alert("Usuario deletado com sucesso!");document.getElementById("' . 'formIdUsuario' . $matricula . '").style.visibility = "hidden"';
        } else {
            return "alert('Erro ao deletar!');document.getElementById(\"formUsuario\").reset();";
        }
    }

}

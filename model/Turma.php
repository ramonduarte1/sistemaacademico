<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Turma
 *
 * @author usuario
 */
class Turma {

    private $codigo;
    private $nome;
    private $dataAltera;
    private $usuarioAltera;
    private $conexao;

    function __construct() {
        $this->conexao = new Conexao();
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    function getDataAltera() {
        return $this->dataAltera;
    }

    function getUsuarioAltera() {
        return $this->usuarioAltera;
    }

    function setDataAltera($dataAltera) {
        $this->dataAltera = $dataAltera;
    }

    function setUsuarioAltera($usuarioAltera) {
        $this->usuarioAltera = $usuarioAltera;
    }

    function getCodigo() {
        return $this->codigo;
    }

    function getNome() {
        return $this->nome;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    public function salvarNoBanco() {

        $sql = "INSERT INTO turma (nome,data_altera,usuario_altera) VALUES (:nome,:data_altera,:usuario_altera)";
        $insert = $this->conexao->prepare($sql);

        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d H:i');

        $bind = array
            (
            ':nome' => $this->getNome(),
            ':data_altera' => $date,
            ':usuario_altera' => $this->getUsuarioAltera()
        );

        $insert->execute($bind);

        if ($insert != FALSE) {
            return "Inserido com sucesso!";
        } else {
            return "Ocorreu um erro ao inserir!";
        }
    }

    public function atualizar() {
        $sql = "UPDATE turma SET nome = :nome,data_altera = :data_altera, usuario_altera = :usuario_altera WHERE id = :id";
        $insert = $this->conexao->prepare($sql);


        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d H:i');

        $bind = array
            (
            ':nome' => $this->getNome(),
            ':id' => $this->getCodigo(),
            ':data_altera' => $date,
            ':usuario_altera' => $this->getUsuarioAltera()
        );

        $insert->execute($bind);

        if ($insert != FALSE) {
            return "Turma alterada com sucesso!";
        } else {
            return "Ocorreu um erro ao alterar!";
        }
    }

    public function apagar() {
        $sql = "select *from turma inner join turma_disciplina on (turma.id = turma_disciplina.turma_id) where deletado = 'n' and id = '" . $this->getCodigo() . "'";
        $insert = $this->conexao->query($sql);

        if ($insert->rowCount() > 0) {// se existir turma com matriculas ativa
            return "Turma não pode ser deletado!";
        } else {
            $sql = "UPDATE turma SET deletado = :deletado,data_altera = :data_altera, usuario_altera = :usuario_altera WHERE id = :id";
            $insert = $this->conexao->prepare($sql);

            date_default_timezone_set('America/Sao_Paulo');
            $date = date('Y-m-d H:i');

            $bind = array
                (
                ':deletado' => 's',
                ':data_altera' => $date,
                ':usuario_altera' => $this->getUsuarioAltera(),
                ':id' => $this->getCodigo()
            );
            $insert->execute($bind);

            if ($insert != FALSE) {
                return "Turma apagado com sucesso!";
            } else {
                return "Ocorreu um erro!";
            }
        }
    }

    public function retornaTurmas($tipo, $pesquisa) {

        if ($tipo == '1') {// disciplinas matriculados
            $sql = "select *from turma inner join turma_disciplina on (turma.id = turma_disciplina.turma_id) where turma.nome like '%$pesquisa%' and turma.deletado = 'n'";
        } else {
            $sql = "select *from turma left join turma_disciplina on (turma.id = turma_disciplina.turma_id) where turma_disciplina.turma_id is null and turma.nome like '%$pesquisa%' and turma.deletado = 'n'";
        }
        $array = array();
        $insert = $this->conexao->query($sql);
        foreach ($insert as $disciplina) {
            array_push($array, $disciplina);
        }
        $a = 1;
        return $array;
    }

    public function retornaTurma() {
        $id = $this->getCodigo();
        $sql = "select *from turma where id = '$id' and disciplina.deletado = 'n'";

        $insert = $this->conexao->query($sql);
        $array = array();
        foreach ($insert as $disciplina) {
            array_push($array, $disciplina);
        }
        return $array;
    }

}

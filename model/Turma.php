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
    private $disciplinas;
    private $dataAltera;
    private $usuarioAltera;
    private $conexao;

    function __construct() {
        $this->conexao = new Conexao();
        $this->disciplinas = array();
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    function getDisciplinas() {
        return $this->disciplinas;
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

    function setDisciplinas($disciplinas) {
        $this->disciplinas = $disciplinas;
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

        $sql = "SELECT last_value from turma_id_seq";
        $utimoIdTurma = $this->conexao->query($sql);
        foreach ($utimoIdTurma as $value) {
            $idTurma = $value;
        }

        if ($insert != FALSE) { // se tiver inserido a turma  salva tambem na tabela turma_disciplina
            foreach ($this->getDisciplinas() as $idDisciplina) {
                $sql = "INSERT INTO turma_disciplina VALUES (:turma_id,:disciplina_id)";
                $insert = $this->conexao->prepare($sql);

                date_default_timezone_set('America/Sao_Paulo');
                $date = date('Y-m-d H:i');

                $bind = array
                    (
                    ':turma_id' => $idTurma[0],
                    ':disciplina_id' => $idDisciplina
                );

                $insert->execute($bind);
            }
            return "Inserido com sucesso!";
        } else {
            return "Ocorreu um erro ao inserir!";
        }
    }

    public function atualizar() {
        $sql = "UPDATE turma SET nome = :nome, data_altera = :data_altera, usuario_altera = :usuario_altera WHERE id = :id";
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
            //apaga o registro anterior para gravar as novas disciplinas
            $sql = "delete from turma_disciplina where turma_id = ".$this->getCodigo()."";
            $this->conexao->query($sql);

            foreach ($this->getDisciplinas() as $idDisciplina) {
                $sql = "INSERT INTO turma_disciplina VALUES (:turma_id,:disciplina_id)";
                $insert = $this->conexao->prepare($sql);

                date_default_timezone_set('America/Sao_Paulo');
                $date = date('Y-m-d H:i');

                $bind = array
                    (
                    ':turma_id' => $this->getCodigo(),
                    ':disciplina_id' => $idDisciplina
                );

                $insert->execute($bind);
            }

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

        if ($tipo == '1') {// nome
            $sql = "select *from turma where turma.nome like '%$pesquisa%' and turma.deletado = 'n'";
        }
        if ($tipo == '2') {// codigo
            $sql = "select *from turma where turma.id = ".$pesquisa." and turma.deletado = 'n'";
        } 
        $array = array();
        $insert = $this->conexao->query($sql);
        foreach ($insert as $turma) {
            array_push($array, $turma);
        }
        return $array;
    }

    public function retornaTurma() {
        $id = $this->getCodigo();
        $sql = "select *from turma where id = '$id' and deletado = 'n'";

        $insert = $this->conexao->query($sql);
        $array = array();
        foreach ($insert as $turma) {
            array_push($array, $turma);
        }
        return $array;
    }
    

}

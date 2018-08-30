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
    private $conexao;

    function __construct() {
        $this->conexao = new Conexao();
        if (!isset($_SESSION['turmas'])) {
            session_start();
        }
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

    public function cadastrar() {

        $sql = "INSERT INTO turma (nome) VALUES (:nome)";
        $insert = $this->conexao->prepare($sql);
        $bind = array
            (
            ':nome' => $this->getNome()
        );

        $insert->execute($bind);

        if ($insert != FALSE) {
            echo "<script>alert('Inserido com sucesso!');location.href=\"../view/cadastro_turma.php\"</script> ";
        } else {
            echo "<script>alert('Ocorreu um erro ao inserir!');location.href=\"../view/cadastro_turma.php\"</script> ";
        }
    }

    public function atualizar() {
        $sql = "UPDATE turma SET nome = :nome WHERE id = :id";
        $insert = $this->conexao->prepare($sql);

        $bind = array
            (
            ':nome' => $this->getNome(),
            ':id' => $this->getCodigo()
        );

        $insert->execute($bind);

        if ($insert != FALSE) {
            echo "<script>alert('Turma alterada com sucesso!');location.href=\"../view/consulta_turma.php\"</script> ";
        } else {
            echo "<script>alert('Ocorreu um erro ao alterar!');location.href=\"../view/consulta_turma.php\"</script> ";
        }
    }

    public function apagar() {
        $sql = "select *from turma inner join turma_disciplina on (turma.id = turma_disciplina.turma_id) where id = '" . $this->getCodigo() . "'";
        $insert = $this->conexao->query($sql);

        if ($insert->rowCount() > 0) {// se existir disciplina matriclada na turma
            echo "<script>alert('Turma não pode ser deletado!');location.href=\"../view/consulta_turma.php\"</script> ";
        } else {
            $sql = "delete from turma where id = :matricula ";
            $insert = $this->conexao->prepare($sql);
            $insert->bindParam(':matricula', $this->getCodigo());
            $insert->execute();
            if ($insert != FALSE) {
                echo "<script>alert('Turma apagado com sucesso!');location.href=\"../view/consulta_turma.php\"</script> ";
            } else {
                echo "<script>alert('Ocorreu um erro!');location.href=\"../view/consulta_turma.php\"</script> ";
            }
        }
    }

}

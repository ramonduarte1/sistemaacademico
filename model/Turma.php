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
        if (!isset($_SESSION['turmas'])) {
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

    public function cadastrar() {

        $sql = "INSERT INTO turma (nome,data_altera,usuario_altera) VALUES (:nome,:data_altera,:usuario_altera)";
        $insert = $this->conexao->prepare($sql);
                
        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d H:i');
        
        $bind = array
            (
            ':nome' => $this->getNome(),
            ':data_altera' => $date,
            ':usuario_altera'=> $this->getUsuarioAltera()
        );

        $insert->execute($bind);

        if ($insert != FALSE) {
            echo "<script>alert('Inserido com sucesso!');location.href=\"../view/cadastro_turma.php\"</script> ";
        } else {
            echo "<script>alert('Ocorreu um erro ao inserir!');location.href=\"../view/cadastro_turma.php\"</script> ";
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
            ':usuario_altera'=> $this->getUsuarioAltera()
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

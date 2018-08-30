<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Aluno
 *
 * @author ramon
 */
class Aluno extends Pessoa {

    private $turma_id;
    private $conexao;

    function __construct() {
        if (!session_status()) {
            session_start();
        }
        $this->notas = array();
        $this->conexao = new Conexao();
    }

    function getTurma_id() {
        return $this->turma_id;
    }

    function setTurma_id($turma_id) {
        $this->turma_id = $turma_id;
    }

    public function cadastrar() {
        $sql = "INSERT INTO aluno (nome,email,endereco,telefone,usuario_altera,data_altera) VALUES (:nome,:email,:endereco,:telefone,:usuario_altera,:data_altera)";
        $insert = $this->conexao->prepare($sql);

        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d H:i');

        $bind = array(
            'nome' => $this->getNome(),
            'email' => $this->getEmail(),
            'endereco' => $this->getEndereco(),
            'telefone' => $this->getTelefone(),
            'usuario_altera' => $this->getUsuarioAltera(),
            'data_altera' => $date
        );
        $insert->execute($bind);



        if ($insert != FALSE) {
            echo "<script>alert('Aluno cadastrado com sucesso!');location.href=\"../view/cadastro_aluno.php\"</script> ";
        } else {
            echo "<script>alert('Ocorreu um erro ao cadastrar!');location.href=\"../view/cadastro_aluno.php\"</script> ";
        }
    }

    public function apagar() {

        $sql = "select *from aluno inner join aluno_disciplina on (aluno.id = aluno_disciplina.aluno_id) where id = '" . $this->getMatricula() . "'";
        $insert = $this->conexao->query($sql);

        if ($insert->rowCount() > 0) {// se o aluno tiver matricula ativa
            echo "<script>alert('Aluno não pode ser deletado!');location.href=\"../view/consulta_aluno.php\"</script> ";
        } else {
            $sql = "UPDATE aluno SET delete = :delete, usuario_altera = :usuario_altera, data_altera= :data_altera WHERE id = :id";
            $insert = $this->conexao->prepare($sql);

            date_default_timezone_set('America/Sao_Paulo');
            $date = date('Y-m-d H:i');

            $bind = array(
                'delete' => 's',
                'usuario_altera' => $this->getUsuarioAltera(),
                'data_altera' => $date,
                'id' => $this->getMatricula()
            );
            $insert->execute($bind);
            if ($insert != FALSE) {
                echo "<script>alert('Aluno apagado com sucesso!');location.href=\"../view/consulta_aluno.php\"</script> ";
            } else {
                echo "<script>alert('Ocorreu um erro!');location.href=\"../view/consulta_aluno.php\"</script> ";
            }
        }
    }

    public function atualizar() {
        $sql = "UPDATE aluno SET nome = :nome ,email = :email ,endereco= :endereco, "
                . "telefone= :telefone , usuario_altera = :usuario_altera, data_altera= :data_altera WHERE id = :id";
        $insert = $this->conexao->prepare($sql);

        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d H:i');

        $bind = array(
            'nome' => $this->getNome(),
            'email' => $this->getEmail(),
            'endereco' => $this->getEndereco(),
            'telefone' => $this->getTelefone(),
            'id' => $this->getMatricula(),
            'usuario_altera' => $this->getUsuarioAltera(),
            'data_altera' => $date
        );
        $insert->execute($bind);

        if ($insert != FALSE) {
            echo "<script>alert('Aluno alterado com sucesso!');location.href=\"../view/consulta_aluno.php\"</script> ";
        } else {
            echo "<script>alert('Ocorreu um erro ao alterar!');location.href=\"../view/consulta_aluno.php\"</script> ";
        }
    }

}

// criar atibutos data_altera usuario_altera para servir como log, salvar usuario na sessao
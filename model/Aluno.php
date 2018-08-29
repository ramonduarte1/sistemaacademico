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
        $sql = "INSERT INTO aluno (nome,email,endereco,telefone) VALUES (:nome,:email,:endereco,:telefone)"; //'".$this->getNome()."'
        $insert = $this->conexao->prepare($sql);

        $bind = array('nome' => $this->getNome(), 'email' => $this->getEmail(), 'endereco' => $this->getEndereco(),
            'telefone' => $this->getTelefone());
        $insert->execute($bind);

        if ($insert != FALSE) {
            echo "<script>alert('Aluno cadastrado com sucesso!');location.href=\"../view/cadastro_aluno.php\"</script> ";
        } else {
            echo "<script>alert('Ocorreu um erro ao cadastrar!');location.href=\"../view/cadastro_aluno.php\"</script> ";
        }
    }

    public function apagar() {
        
        $sql = "select *from aluno inner join aluno_disciplina on (aluno.id = aluno_disciplina.aluno_id) where id = '".$this->getMatricula()."'";
        $insert = $this->conexao->query($sql);
        
        if ($insert->rowCount() > 0) {
            echo "<script>alert('Aluno não pode ser deletado!');location.href=\"../view/cadastro_aluno.php\"</script> ";
        } else {
            $sql = "delete from aluno where id = :matricula ";
            $insert = $this->conexao->prepare($sql);
            $insert->bindParam(':matricula', $this->getMatricula());
            $insert->execute();
            echo "<script>alert('Aluno apagado com sucesso!');location.href=\"../view/cadastro_aluno.php\"</script> ";
        }
    }

    public function incluirNotas() {
        
    }

}

// criar atibutos data_altera usuario_altera para servir como log, salvar usuario na sessao
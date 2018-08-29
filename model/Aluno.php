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
        $insert->bindParam(':nome', $this->getNome());
        $insert->bindParam(':email', $this->getEmail());
        $insert->bindParam(':endereco', $this->getEndereco());
        $insert->bindParam(':telefone', $this->getTelefone());

        $insert->execute();

        if ($insert != FALSE) {
            echo "<script>alert('Aluno cadastrado com sucesso!');location.href=\"../view/cadastro_aluno.php\"</script> ";
        } else {
            echo "<script>alert('Ocorreu um erro ao cadastrar!');location.href=\"../view/cadastro_aluno.php\"</script> ";
        }
    }

    public function apagar() {

        if (isset($_SESSION['alunos_matriculados'][$this->getMatricula()])) {
            echo "<script>alert('Aluno não pode ser deletado, devido a uma matricula ativa!');location.href=\"../view/cadastro_aluno.php\"</script> ";
        } else {
            unset($_SESSION['alunos'][$this->getMatricula()]);
            require_once '../controller/NumeroMatriculaController.php';
            echo "<script>alert('Aluno apagado com sucesso!');location.href=\"../view/cadastro_aluno.php\"</script> ";
        }
    }

    public function incluirNotas() {
        
    }

}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Professor
 *
 * @author ramon
 */
class Professor extends Pessoa {

    private $conexao;

    function __construct() {
        $this->conexao = new Conexao();
    }

    public function cadastrar() {
        $sql = "INSERT INTO professor (nome,email,endereco,telefone) VALUES (:nome,:email,:endereco,:telefone)"; //'".$this->getNome()."'
        $insert = $this->conexao->prepare($sql);
        $insert->bindParam(':nome', $this->getNome());
        $insert->bindParam(':email', $this->getEmail());
        $insert->bindParam(':endereco', $this->getEndereco());
        $insert->bindParam(':telefone', $this->getTelefone());

        $insert->execute();

        if ($insert != FALSE) {
            echo "<script>alert('Professor cadastrado com sucesso!');location.href=\"../view/cadastro_professor.php\"</script> ";
        } else {
            echo "<script>alert('Ocorreu um erro ao cadastrar!');location.href=\"../view/cadastro_professor.php\"</script> ";
        }
    }

    public function apagar() {
        unset($_SESSION['professores'][$this->getMatricula()]);
        require_once '../controller/NumeroMatriculaController.php';
    }

}

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
        if (!session_status()) {
            session_start();
        }
    }

    public function salvaNoBanco() {
        $sql = "INSERT INTO professor (nome,email,endereco,telefone,usuario_altera,data_altera) VALUES (:nome,:email,:endereco,:telefone,:usuario_altera,:data_altera)";
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
            return "Professor cadastrado com sucesso!";
        } else {
            return "Ocorreu um erro ao cadastrar!";
        }
    }

    public function atualizar() {
        $sql = "UPDATE professor SET nome = :nome ,email = :email ,endereco= :endereco, telefone= :telefone, usuario_altera = :usuario_altera, data_altera = :data_altera WHERE id = :id";
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
            return "Professor alterado com sucesso!";
        } else {
            return "Ocorreu um erro ao alterar!";
        }
    }

    public function apagar() {

        $sql = "select *from professor inner join turma_professor on (professor.id = turma_professor.professor_id) where id = '" . $this->getMatricula() . "'";
        $insert = $this->conexao->query($sql);

        if ($insert->rowCount() > 0) {// se o aluno tiver matricula ativa
            echo "<script>alert('Professor não pode ser deletado!');location.href=\"../view/consulta_professor.php\"</script> ";
        } else {
            $sql = "UPDATE professor SET deletado = :deletado, usuario_altera = :usuario_altera, data_altera = :data_altera WHERE id = :id";
            $insert = $this->conexao->prepare($sql);

            date_default_timezone_set('America/Sao_Paulo');
            $date = date('Y-m-d H:i');

            $bind = array(
                'deletado' => 's',
                'usuario_altera' => $this->getUsuarioAltera(),
                'data_altera' => $date,
                'id' => $this->getMatricula()
            );
            $insert->execute($bind);
            if ($insert != FALSE) {
                return "Professor apagado com sucesso!";
            } else {
                echo "Ocorreu um erro!";
            }
        }
    }

    public function retornaProfessores($tipo, $pesquisa) {

        if ($tipo == '1') {// professor matriculados
            $sql = "select *from professor inner join turma_professor on (professor.id = turma_professor.professor_id) where professor.nome like '%$pesquisa%' and professor.deletado = 'n'";
        } else {
            $sql = "select *from professor left join turma_professor on (professor.id = turma_professor.professor_id) where turma_professor.professor_id is null and professor.nome like '%$pesquisa%' and professor.deletado = 'n'";
        }
        $array = array();
        $insert = $this->conexao->query($sql);
        foreach ($insert as $professor) {
            array_push($array, $professor);
        }

        return $array;
    }

    public function retornaProfessor() {
        $id = $this->getMatricula();
        $sql = "select *from professor left join turma_professor on (professor.id = turma_professor.professor_id) where turma_professor.professor_id is null and professor.id = '$id' and professor.deletado = 'n'";

        $insert = $this->conexao->query($sql);
        $array = array();
        foreach ($insert as $professor) {
            array_push($array, $professor);
        }
        return $array;
    }

}

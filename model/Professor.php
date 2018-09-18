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
    private $disciplinas;

    function __construct() {
        $this->conexao = new Conexao();
        $this->disciplinas = array();
    }

    function getDisciplinas() {
        return $this->disciplinas;
    }

    function setDisciplinas($disciplinas) {
        $this->disciplinas = $disciplinas;
    }

    public function salvar() {
        $sql = "INSERT INTO professor (nome,email,endereco,telefone,usuario_altera,data_altera) VALUES (:nome,:email,:endereco,:telefone,:usuario_altera,:data_altera)";
        $insert = $this->conexao->prepare($sql);

        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d H:i');

        $bind = array(
            'nome' => $this->getNome(),
            'email' => $this->getEmail(),
            'endereco' => $this->getEndereco(),
            'telefone' => $this->getTelefone(),
            'usuario_altera' => $_SESSION['login'],
            'data_altera' => $date
        );
        $insert->execute($bind);


        if ($insert != FALSE) { // se tiver inserido o professor  salva tambem na tabela professor_disciplina
            $sql = "SELECT last_value from professor_id_seq";
            $utimoIdProfessor = $this->conexao->query($sql);

            foreach ($utimoIdProfessor as $value) {
                $idProfessor = $value;
            }

            foreach ($this->getDisciplinas() as $idDisciplina) {
                $sql = "INSERT INTO professor_disciplina VALUES (:professor_id,:disciplina_id,:data_altera,:usuario_altera)";
                $insert = $this->conexao->prepare($sql);

                $bind = array
                    (
                    ':professor_id' => $idProfessor[0],
                    ':disciplina_id' => $idDisciplina,
                    ':data_altera' => $date,
                    ':usuario_altera' => $_SESSION['login']
                );

                $insert->execute($bind);
            }
            return "alert('Inserido com sucesso!');document.getElementById(\"formProfessor\").reset();";
        } else {
            return "alert('Ocorreu um erro ao inserir!');";
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
            'usuario_altera' => $_SESSION['login'],
            'data_altera' => $date
        );
        $insert->execute($bind);

        if ($insert != FALSE) {
            //apaga o registro anterior para gravar as novas disciplinas
            $sql = "delete from professor_disciplina where professor_id = " . $this->getMatricula() . "";
            $this->conexao->query($sql);

            foreach ($this->getDisciplinas() as $idDisciplina) {
                $sql = "INSERT INTO professor_disciplina VALUES (:professor_id,:disciplina_id,:data_altera,:usuario_altera)";
                $insert = $this->conexao->prepare($sql);

                date_default_timezone_set('America/Sao_Paulo');
                $date = date('Y-m-d H:i');

                $bind = array
                    (
                    ':professor_id' => $this->getMatricula(),
                    ':disciplina_id' => $idDisciplina,
                    ':data_altera' => $date,
                    ':usuario_altera' => $_SESSION['login']
                );

                $insert->execute($bind);
            }

            return "alert('Registro alterado com sucesso!');";
        } else {
            return "alert('Ocorreu um erro ao alterar!!');";
        }
    }

    public function apagar() {

        $sql = "select *from professor inner join professor_disciplina on (professor.id = professor_disciplina.professor_id) where id = '" . $this->getMatricula() . "'";
        $insert = $this->conexao->query($sql);

        if ($insert->rowCount() > 0) {// se o professor tiver disciplina ativa
            return 'alert("O registro não pode ser deletado!");';
        } else {
            $sql = "UPDATE professor SET deletado = :deletado, usuario_altera = :usuario_altera, data_altera = :data_altera WHERE id = :id";
            $insert = $this->conexao->prepare($sql);

            date_default_timezone_set('America/Sao_Paulo');
            $date = date('Y-m-d H:i');

            $bind = array(
                'deletado' => 's',
                'usuario_altera' => $_SESSION['login'],
                'data_altera' => $date,
                'id' => $this->getMatricula()
            );
            $insert->execute($bind);
            if ($insert != FALSE) {
                return 'alert("Registro deletado com sucesso!");document.getElementById("' . 'formIdProfessor' . $this->getMatricula() . '").style.visibility = "hidden"';
            } else {
                echo 'alert("Ocorreu um erro ao deletar o registro!");';
            }
        }
    }

    public function retornaProfessores($tipo, $pesquisa) {

        if ($tipo == '1') {//professor por nome
            $sql = "select *from professor where nome like '%$pesquisa%' and professor.deletado = 'n' order by id asc";
//          $sql = "select *from professor inner join turma_professor on (professor.id = turma_professor.professor_id) where professor.nome like '%$pesquisa%' and professor.deletado = 'n'";
        } else {//professor por matricula
            $sql = "select *from professor where id = '$pesquisa' and professor.deletado = 'n'";
//          $sql = "select *from professor left join turma_professor on (professor.id = turma_professor.professor_id) where turma_professor.professor_id is null and professor.nome like '%$pesquisa%' and professor.deletado = 'n'";
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
        $sql = "select *from professor where id = '$id' and professor.deletado = 'n'";

        $insert = $this->conexao->query($sql);
        $array = array();
        foreach ($insert as $professor) {
            array_push($array, $professor);
        }
        return $array;
    }

    public function retornaDisciplinasDoProfessor() {
        $sql = "select professor.id id_prof, professor.nome nome_prof , disciplina.id id_disc ,disciplina.nome nome_disc, disciplina.carga_horaria from professor "
                . "inner join professor_disciplina on (professor.id = professor_disciplina.professor_id) "
                . "inner join disciplina on (disciplina.id = professor_disciplina.disciplina_id) order by professor.id";

        $consulta = $this->conexao->query($sql);
        $array = array();
        foreach ($consulta as $professorD) {
            array_push($array, $professorD);
        }
        return $array;
    }

//select professor.id, professor.nome , disciplina.id ,disciplina.nome, disciplina.carga_horaria from professor inner join professor_disciplina on (professor.id = professor_disciplina.professor_id) inner join disciplina on (disciplina.id = professor_disciplina.disciplina_id)
}

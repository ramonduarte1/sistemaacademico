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

    public function salvaNoBanco() {
        $sql = "INSERT INTO aluno (nome,email,endereco,telefone,usuario_altera,data_altera) VALUES (:nome,:email,:endereco,:telefone,:usuario_altera,:data_altera)";
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

        if ($insert != FALSE) {
            return "Aluno cadastrado com sucesso!";
        } else {
            return "Ocorreu um erro ao cadastrar!";
        }
    }

    public function apagar() {

        $sql = "select *from aluno inner join aluno_disciplina on (aluno.id = aluno_disciplina.aluno_id) where id = '" . $this->getMatricula() . "' and deletado ='n' ";
        $insert = $this->conexao->query($sql);

        if ($insert->rowCount() > 0) {// se o aluno tiver matricula ativa
            echo "<script>alert('Aluno não pode ser deletado!');location.href=\"../view/consulta_aluno.php\"</script> ";
        } else {
            $sql = "UPDATE aluno SET deletado =:deletado, usuario_altera = :usuario_altera, data_altera= :data_altera WHERE id = :id";
            $insert = $this->conexao->prepare($sql);

            date_default_timezone_set('America/Sao_Paulo');
            $date = date('Y-m-d H:i');

            $bind = array(
                ':deletado' => 's',
                ':usuario_altera' => $this->getUsuarioAltera(),
                ':data_altera' => $date,
                ':id' => $this->getMatricula()
            );
            $insert->execute($bind);
            if ($insert != FALSE) {
                return "Aluno deletado com sucesso!";
            } else {
                return "Ocorreu um erro!";
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
            return "Aluno alterado com sucesso!";
        } else {
            return "Ocorreu um erro ao alterar!";
        }
    }

    public function adicionarTurma() {
        $sql = "UPDATE aluno SET turma_id = " . $this->getTurma_id() . ", usuario_altera = :usuario_altera, data_altera = :data_altera WHERE id =" . $this->getMatricula() . " ";
        $insert = $this->conexao->prepare($sql);

        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d H:i');

        $bind = array(
            ':usuario_altera' => $_SESSION['login'],
            ':data_altera' => $date
        );
        $insert->execute($bind);



        $sql = "INSERT INTO aluno_disciplina VALUES (:aluno_id, :disciplina_id, :nota1, :nota2, :nota3,:media)";
        $entrada = $this->conexao->prepare($sql);
        
        $d = new Disciplina();
        $disciplinas = $d->retornaDisciplinasPorTurma($this->getTurma_id());
        foreach ($disciplinas as $key => $codigo) {

           
            $bind2 = array
                (
                ':aluno_id' => $this->getMatricula(),
                ':disciplina_id' => $codigo['id'],
                ':nota1' => 0.0,
                ':nota2' => 0.0,
                ':nota3' => 0.0,
                ':media' => 0.0
            );
            $resposta = $entrada->execute($bind2);
        }













/// ja deixar gravado na tabela aluno_disciplina para no controller apenas usar o update
        if ($insert != FALSE && $entrada != FALSE) {
            unset($_SESSION['matricula']);//quando matricular apaga a sessao matricula

            return "Sucesso!";
        } else {
            return "Ocorreu um erro!";
        }
    }

    public function retornaAlunos($tipo, $pesquisa) {
        $a = 1;
        if ($tipo == '1') {// alunos matriculados por nome
            $sql = "select *from aluno where turma_id notnull and aluno.nome like '%$pesquisa%' and aluno.deletado = 'n'";
        }
        if ($tipo == '2') {// alunos matriculados por matricula
            $sql = "select *from aluno where turma_id isnull and  where id = " . $pesquisa . " and aluno.deletado = 'n'";
        }
        if ($tipo == '3') {// alunos nao matriculados por nome
            $sql = "select *from aluno left join aluno_disciplina on (aluno.id = aluno_disciplina.aluno_id) where aluno_disciplina.aluno_id is null and aluno.nome like '%$pesquisa%' and aluno.deletado = 'n'";
        }
        if ($tipo == '4') {// alunos nao matriculados por matricula
            $sql = "select *from aluno left join aluno_disciplina on (aluno.id = aluno_disciplina.aluno_id) where aluno_disciplina.aluno_id is null and aluno.id = " . $pesquisa . " and aluno.deletado = 'n'";
        }
        $array = array();
        $insert = $this->conexao->query($sql);
        foreach ($insert as $aluno) {
            array_push($array, $aluno);
        }

        return $array;
    }

    public function retornaAluno() {
        $id = $this->getMatricula();
        $sql = "select *from aluno where id = '$id' and aluno.deletado = 'n'";

        $insert = $this->conexao->query($sql);
        $array = array();
        foreach ($insert as $aluno) {
            array_push($array, $aluno);
        }
        return $array;
    }

    public function pesqMenuMatricula($form) {
        if ($form['radio'] == 1) {
            $sql = "select *from aluno where nome like '%" . $form['pesq_aluno'] . "%' and aluno.deletado = 'n' and turma_id notnull";
        }
        if ($form['radio'] == 2) {
            $sql = "select *from aluno where id = " . $form['pesq_aluno'] . " and aluno.deletado = 'n'";
        }
        if ($form['radio'] == 3) {
            $sql = "select *from aluno where turma_id = " . $form['pesq_aluno'] . " and aluno.deletado = 'n'";
        }

        $insert = $this->conexao->query($sql);
        $array = array();
        foreach ($insert as $aluno) {
            array_push($array, $aluno);
        }
        return $array;
    }

    public function matriculados($form) {
        if ($form['radio'] == 1) {
            $sql = "select *from aluno where turma_id notnull and aluno.deletado = 'n'";
        }
        if ($form['radio'] == 2) {
            $sql = "select *from aluno where turma_id is null and aluno.deletado = 'n'";
        }
        $insert = $this->conexao->query($sql);
        $array = array();
        foreach ($insert as $aluno) {
            array_push($array, $aluno);
        }
        return $array;
    }

}

// criar atibutos data_altera usuario_altera para servir como log, salvar usuario na sessao
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Disciplina
 *
 * @author ramon
 */
class Disciplina {

    private $codigo;
    private $nome;
    private $professor_id;
    private $cargaHoraria;
    private $usuarioAltera;
    private $dataAltera;
    private $conexao;
    private $nota1;
    private $nota2;
    private $nota3;

    function __construct() {
        $this->conexao = new Conexao();
    }

    function getProfessor_id() {
        return $this->professor_id;
    }

    function setProfessor_id($professor_id) {
        $this->professor_id = $professor_id;
    }

    function getUsuarioAltera() {
        return $this->usuarioAltera;
    }

    function getDataAltera() {
        return $this->dataAltera;
    }

    function setUsuarioAltera($usuarioAltera) {
        $this->usuarioAltera = $usuarioAltera;
    }

    function setDataAltera($dataAltera) {
        $this->dataAltera = $dataAltera;
    }

    function getNota1() {
        return $this->nota1;
    }

    function getNota2() {
        return $this->nota2;
    }

    function getNota3() {
        return $this->nota3;
    }

    function setNota1($nota1) {
        $this->nota1 = $nota1;
    }

    function setNota2($nota2) {
        $this->nota2 = $nota2;
    }

    function setNota3($nota3) {
        $this->nota3 = $nota3;
    }

    function getCargaHoraria() {
        return $this->cargaHoraria;
    }

    function setCargaHoraria($cargaHoraria) {
        $this->cargaHoraria = $cargaHoraria;
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

    public function salvarNoBanco() {
        $sql = "INSERT INTO disciplina (nome,carga_horaria,data_altera,usuario_altera) VALUES (:nome,:carga_horaria,:data_altera,:usuario_altera)";
        $insert = $this->conexao->prepare($sql);

        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d H:i');


        $bind = array
            (
            ':nome' => $this->getNome(),
            ':carga_horaria' => $this->getCargaHoraria(),
            ':data_altera' => $date,
            ':usuario_altera' => $this->getUsuarioAltera()
        );

        $insert->execute($bind);

        if ($insert != FALSE) {
            return "alert('Disciplina cadastrado com sucesso!');document.getElementById(\"formDisciplina\").reset();";
        } else {
            return "alert('Ocorreu um erro ao cadastrar!');";
        }
    }

    public function atualizar() {
        $sql = "UPDATE disciplina SET nome = :nome ,carga_horaria = :carga_horaria, data_altera = :data_altera, usuario_altera = :usuario_altera WHERE id = :id";
        $insert = $this->conexao->prepare($sql);

        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d H:i');

        $bind = array
            (
            ':nome' => $this->getNome(),
            ':carga_horaria' => $this->getCargaHoraria(),
            ':id' => $this->getCodigo(),
            ':data_altera' => $date,
            ':usuario_altera' => $this->getUsuarioAltera()
        );

        $insert->execute($bind);
        $a = 1;
        if ($insert != FALSE) {
            return "Disciplina cadastrada com sucesso!";
        } else {
            return "Ocorreu um erro ao cadastrar!";
        }
    }

    public function apagar() {

        $sql = "select *from disciplina inner join turma_disciplina on (disciplina.id = turma_disciplina.disciplina_id) where id = '" . $this->getCodigo() . "'";
        $insert = $this->conexao->query($sql);

        if ($insert->rowCount() > 0) {// se existir disciplina matriclada numa turma
            return 'alert("Registro não pode ser deletado!");';
        } else {
            $sql = "UPDATE disciplina SET deletado = :deletado, data_altera = :data_altera, usuario_altera = :usuario_altera WHERE id = :id";
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
                return 'alert("Registro deletado com sucesso!");document.getElementById("'.'formIdDisciplina'.$this->getCodigo().'").style.visibility = "hidden"';
            } else {
                return 'alert("Ocorreu um erro ao deletar o registro!");';
            }
        }
    }

    public function retornaDisciplinas($tipo, $pesquisa) {

        if ($tipo == '1') {// disciplinas por nome
            $sql = "select *from disciplina where nome like '%$pesquisa%' and disciplina.deletado = 'n' order by id";
//            $sql = "select *from disciplina inner join turma_disciplina on (disciplina.id = turma_disciplina.disciplina_id) where disciplina.nome like '%$pesquisa%' and disciplina.deletado = 'n'";
        } else {//disciplinas por matricula
            $sql = "select *from disciplina where id = '$pesquisa' and disciplina.deletado = 'n'";
//            $sql = "select *from disciplina left join turma_disciplina on (disciplina.id = turma_disciplina.disciplina_id) where turma_disciplina.disciplina_id is null and disciplina.nome like '%$pesquisa%' and disciplina.deletado = 'n'";
            
        }
        $array = array();
        $insert = $this->conexao->query($sql);
        foreach ($insert as $disciplina) {
            array_push($array, $disciplina);
        }
        
        return $array;
    }

    public function retornaDisciplina() {
        $id = $this->getCodigo();
        $sql = "select *from disciplina where id = '$id' and disciplina.deletado = 'n'";

        $insert = $this->conexao->query($sql);
        $array = array();
        foreach ($insert as $disciplina) {
            array_push($array, $disciplina);
        }
        return $array;
    }

    public function retornaTodasDisciplinas() {
        $id = $this->getCodigo();
        $sql = "select *from disciplina where deletado = 'n' order by id";
        $insert = $this->conexao->query($sql);
        $array = array();
        foreach ($insert as $disciplina) {
            array_push($array, $disciplina);
        }
        return $array;
    }

    public function retornaDisciplinasPorTurma($id) {
        $sql = "select *from disciplina inner join  turma_disciplina on disciplina.id = turma_disciplina.disciplina_id where turma_disciplina.turma_id ='" . $id . "' order by urma_disciplina.turma_id";
//        $sql = "SELECT disciplina.id, disciplina.nome, disciplina.carga_horaria FROM turma INNER JOIN turma_disciplina ON turma.id = turma_disciplina.turma_id 
//                  and turma_disciplina.turma_id = " . $id . " INNER JOIN disciplina ON turma_disciplina.disciplina_id = disciplina.id";
        $insert = $this->conexao->query($sql);
        $array = array();
        foreach ($insert as $disciplina) {
            array_push($array, $disciplina);
        }
        return $array;
    }

    public function retornaDisciplinasPorProfessor($id) {
        $sql = "select *from disciplina inner join  professor_disciplina on disciplina.id = professor_disciplina.disciplina_id where professor_disciplina.professor_id ='" . $id . "'";
        $insert = $this->conexao->query($sql);
        $array = array();
        foreach ($insert as $disciplina) {
            array_push($array, $disciplina);
        }
        return $array;
    }

}

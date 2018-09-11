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
class AlunoDisciplina {

    private $aluno_id;
    private $conexao;
    private $resposta;
    private $form;

    function __construct() {
        $this->conexao = new Conexao();
    }

    function getAluno_id() {
        return $this->aluno_id;
    }

    function getConexao() {
        return $this->conexao;
    }

    function getResposta() {
        return $this->resposta;
    }

    function getForm() {
        return $this->form;
    }

    function setAluno_id($aluno_id) {
        $this->aluno_id = $aluno_id;
    }

    function setConexao($conexao) {
        $this->conexao = $conexao;
    }

    function setResposta($resposta) {
        $this->resposta = $resposta;
    }

    function setForm($form) {
        $this->form = $form;
    }

    public function retornaNotas() {
        //retorna as disciplinas com as notas do aluno
        $sql = "select *from disciplina inner join  aluno_disciplina on disciplina.id = aluno_disciplina.disciplina_id 
                where aluno_disciplina.aluno_id =" . $this->getAluno_id() . " order by id asc";

        $insert = $this->conexao->query($sql);
        $array = array();
        foreach ($insert as $notas) {
            array_push($array, $notas);
        }
        return $array;
    }

    public function incluirNotas() {
        $form = $this->getForm();

        $disciplinas = $form['disciplinas'];
        $sql = "UPDATE aluno_disciplina SET nota1 = :n1 , nota2 = :n2 , nota3 = :n3, media = :media, situacao = :situacao WHERE aluno_id = :aluno_id and disciplina_id = :disciplina_id";
        $insert = $this->conexao->prepare($sql);

        foreach ($disciplinas as $key => $codigo) {
            $media = ($form[$codigo . n1] + $form[$codigo . n2] + $form[$codigo . n3]) / 3.0;
            $media = number_format($media, 2);

            if ($media >= 7) {
                $situacao = "Aprovado";
            }if ($media < 7 && $media > 4) {
                $situacao = "Recuperação";
            }if ($media < 4) {
                $situacao = "Reprovado";
            }

            $bind = array
                (
                ':aluno_id' => $form['aluno_id'],
                ':disciplina_id' => $codigo,
                ':n1' => $form[$codigo . n1],
                ':n2' => $form[$codigo . n2],
                ':n3' => $form[$codigo . n3],
                ':media' => $media,
                ':situacao' => $situacao
            );

            $this->resposta = $insert->execute($bind);
        }

        if ($this->resposta != FALSE) {
            return "Salvo com sucesso!";
        } else {
            return "Erro ao salvar Notas!";
        }
    }

}

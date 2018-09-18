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
                where aluno_disciplina.aluno_id =" . $this->getAluno_id() . " and aluno_disciplina.deletado = 'n' order by id ";

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

        foreach ($disciplinas as $key => $codigo) {
            $media = ($form[$codigo . n1] + $form[$codigo . n2] + $form[$codigo . n3]) / 3.0;
            $media = number_format($media, 2);

            if ($media >= 7) {
                $situacao = "Aprovado";
            }if ($media < 7 && $media > 4) {
                $situacao = "Recuperacao";
            }if ($media < 4) {
                $situacao = "Reprovado";
            }
            
            date_default_timezone_set('America/Sao_Paulo');
            $date = date('Y-m-d H:i');
            
            $sql = "UPDATE aluno_disciplina SET nota1 = " . $form[$codigo . 'n1'] . " , nota2 =" . $form[$codigo . 'n2'] . "  ,"
                    . " nota3 = " . $form[$codigo . 'n3'] . ", media = " . $media . ", situacao= '" . $situacao . "' , "
                    . "usuario_altera = '" . $_SESSION['login'] . "', data_altera = '" . $date . "' "
                    . "WHERE aluno_id = " . $form['aluno_id'] . " and disciplina_id = " . $codigo;
            $resp = $this->conexao->query($sql);
        }
        if ($resp->rowCount() > 0) { //se ocorreu alguma alteração na tabela é pq deu certo 
            return "alert('Salvo com sucesso!');";
        } else {
            return "alert('Erro ao salvar Notas!');";
        }
    }

}

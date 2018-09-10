<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AlunoDisciplinaController {

    private $objResponse;
    private $conexao;
    private $resposta;
    private $msg;

    function __construct() {
        $this->conexao = new Conexao();
        $this->objResponse = new xajaxResponse(); //instancia o xajax
    }

    public function incluirNotas($form) {
        $disciplinas = $form['disciplinas'];
        $sql = "INSERT INTO aluno_disciplina VALUES (:aluno_id, :disciplina_id, :nota1, :nota2, :nota3,:media)";
        $insert = $this->conexao->prepare($sql);

        foreach ($disciplinas as $key => $codigo) {
            $media = ($form[$codigo . n1] + $form[$codigo . n2] + $form[$codigo . n3]) / 3.0;

            $bind = array
                (
                ':aluno_id' => $form['aluno_id'],
                ':disciplina_id' => $codigo,
                ':nota1' => $form[$codigo . n1],
                ':nota2' => $form[$codigo . n2],
                ':nota3' => $form[$codigo . n3],
                ':media' => $media
            );
            $this->resposta = $insert->execute($bind);
        }

        if ($this->resposta != FALSE) {
            $this->msg = "ok";
        } else {
            $this->msg = "erro";
        }

        $this->objResponse->alert($this->msg);
        return $this->objResponse;
    }

}

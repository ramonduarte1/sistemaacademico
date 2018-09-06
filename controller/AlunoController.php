<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AlunoController
 *
 * @author ramon
 */
class AlunoController {

    private $aluno;
    private $acao;
    private $objResponse;

    function __construct() {
        if (!isset($_SESSION)) {
            session_start();
        }

        $this->objResponse = new xajaxResponse(); //instancia o xajax
    }

    public function pesquisaAluno($form) {
        $aluno = new Aluno();
        $result = $aluno->retornaAlunos($form['radio'], $form['pesq_aluno']);

        $this->objResponse->alert($result);
        return $this->objResponse;
    }

    public function salvarAluno($form) {

        $this->aluno = new Aluno();
        $this->aluno->setNome($form['nome']);
        $this->aluno->setTelefone($form['telefone']);
        $this->aluno->setEmail($form['email']);
        $this->aluno->setEndereco($form['endereco']);

        $result = $this->aluno->salvaNoBanco();

        $this->objResponse->alert($result);

        return $this->objResponse;
    }

    public function adicionarTurma($form) {
        $this->aluno = new Aluno();
        $this->aluno->setMatricula($form['matricula_aluno']);
        $this->aluno->setTurma_id($form['codigo_turma']);
        
        $sql = "UPDATE aluno SET turma_id = " . $this->aluno->getTurma_id(). ", usuario_altera = :usuario_altera, data_altera = :data_altera WHERE id =" . $this->aluno->getMatricula() . " ";
        $insert = $this->conexao->prepare($sql);

        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d H:i');

        $bind = array(
            ':usuario_altera' => $_SESSION['login'],
            ':data_altera' => $date
        );
        $insert->execute($bind);

        if ($insert != FALSE) {
            return "Sucesso!";
        } else {
            return "Ocorreu um erro!";
        }
    }

    public function atualizarAluno($form) {

        $this->aluno = new Aluno();
        $this->aluno->setMatricula($form['matricula']);
        $this->aluno->setNome($form['nome']);
        $this->aluno->setTelefone($form['telefone']);
        $this->aluno->setEmail($form['email']);
        $this->aluno->setEndereco($form['endereco']);

        $result = $this->aluno->atualizar();

        $this->objResponse->alert($result);
        return $this->objResponse;
    }

    public function apagarAluno($form) {

        $this->aluno = new Aluno();
        $this->aluno->setMatricula($form['matricula']);

        $result = $this->aluno->apagar();

        $this->objResponse->alert($result);
        return $this->objResponse;
    }

}

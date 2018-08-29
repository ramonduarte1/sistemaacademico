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
    private $cargaHoraria;
    private $conexao;
    private $nota1;
    private $nota2;
    private $nota3;

    function __construct() {
        $this->conexao = new Conexao();
        if (!isset($_SESSION)) {
            session_start();
        }
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

    public function cadastrar() {
        $sql = "INSERT INTO disciplina (nome,carga_horaria) VALUES (:nome,:carga_horaria)";
        $insert = $this->conexao->prepare($sql); 
        $insert->bindParam(':nome', $this->getNome());
        $insert->bindParam(':carga_horaria', $this->getCargaHoraria());
        $insert->execute();

        if ($insert != FALSE) {
            echo "<script>alert('Disciplina cadastrada com sucesso!');location.href=\"../view/cadastro_disciplina.php\"</script> ";
        } else {
            echo "<script>alert('Ocorreu um erro ao cadastrar!');location.href=\"../view/cadastro_disciplina.php\"</script> ";
        }
    }

    public function atualizar() {
        $sql = "UPDATE disciplina SET nome = :nome ,carga_horaria = :carga_horaria WHERE id = :id";
        $insert = $this->conexao->prepare($sql);
        $insert->bindParam(':nome', $this->getNome());
        $insert->bindParam(':carga_horaria', $this->getCargaHoraria());
        $insert->bindParam(':id', $this->getCodigo());
        
        $insert->execute();

        if ($insert != FALSE) {
            echo "<script>alert('Disciplina alterada com sucesso!');location.href=\"../view/cadastro_disciplina.php\"</script> ";
        } else {
            echo "<script>alert('Ocorreu um erro ao alterar!');location.href=\"../view/cadastro_disciplina.php\"</script> ";
        }
    }

    public function apagar() {

        if (isset($_SESSION['alunos_matriculados'])) {
            $flag = 0;
            foreach ($_SESSION['alunos_matriculados'] as $matAluno => $value) {
                //echo 'key: '.$matAluno.'<br>';
                foreach ($_SESSION['alunos_matriculados'][$matAluno]['disciplina'] as $codigo => $disciplina) {
                    //echo 'se '.$codigo.' === '.$this->getCodigo().'<br>';

                    if ($codigo == $this->getCodigo()) {
                        $flag++;
                        echo "<script>alert('Disciplina não pode ser deletada!');location.href=\"../view/consulta_disciplina.php\"</script> ";
                    }
                }
            }
            if ($flag == 0) { // se nao entrou no if flag continua 0
                unset($_SESSION['disciplinas'][$this->getCodigo()]);
                require_once '../controller/NumeroMatriculaController.php';
                echo "<script>alert('Disciplina deletada com sucesso!');location.href=\"../view/consulta_disciplina.php\"</script> ";
            }
        }
    }

}

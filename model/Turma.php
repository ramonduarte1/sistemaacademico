<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Turma
 *
 * @author usuario
 */
class Turma {

    private $codigo;
    private $nome;
    private $conexao;

    function __construct() {
        $this->conexao = new Conexao();
        if (!isset($_SESSION['turmas'])) {
            session_start();
        }
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

        $sql = "INSERT INTO turma (nome) VALUES (:nome)";
        $insert = $this->conexao->prepare($sql);
        $insert->bindParam(':nome', $this->getNome());

        $insert->execute();

        if ($insert != FALSE) {
            echo "<script>alert('Inserido com sucesso!');location.href=\"../view/cadastro_turma.php\"</script> ";
        } else {
            echo "<script>alert('Ocorreu um erro ao inserir!');location.href=\"../view/cadastro_turma.php\"</script> ";
        }
    }

    public function apagar() {
        if (isset($_SESSION['alunos_matriculados'])) {

            foreach ($_SESSION['alunos_matriculados'] as $matAluno => $value) {
                //echo 'key: '.$matAluno.'<br>';
                $flag = 0;
                foreach ($_SESSION['alunos_matriculados'][$matAluno]['turma'] as $codigo => $turma) {
                    //echo 'se '.$codigo.' === '.$this->getCodigo().'<br>';

                    if ($codigo == $this->getCodigo()) {
                        $flag++;
                        echo "<script>alert('Turma não pode ser deletada, em uso!');location.href=\"../view/consulta_turma.php\"</script> ";
                    }
                }
            }
            if ($flag == 0) { // se nao entrou no if flag continua 0
                unset($_SESSION['turmas'][$this->getCodigo()]);
                require_once '../controller/NumeroMatriculaController.php';
                echo "<script>alert('Turma deletada com sucesso!');location.href=\"../view/consulta_turma.php\"</script> ";
            }
        }
    }

}

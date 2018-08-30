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
    private $usuarioAltera;
    private $dataAltera;
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

    public function cadastrar() {
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
            echo "<script>alert('Disciplina cadastrada com sucesso!');location.href=\"../view/cadastro_disciplina.php\"</script> ";
        } else {
            echo "<script>alert('Ocorreu um erro ao cadastrar!');location.href=\"../view/cadastro_disciplina.php\"</script> ";
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

        if ($insert != FALSE) {
            echo "<script>alert('Disciplina alterada com sucesso!');location.href=\"../view/consulta_disciplina.php\"</script> ";
        } else {
            echo "<script>alert('Ocorreu um erro ao alterar!');location.href=\"../view/consulta_disciplina.php\"</script> ";
        }
    }

    public function apagar() {

        $sql = "select *from disciplina inner join turma_disciplina on (disciplina.id = turma_disciplina.disciplina_id) where id = '" . $this->getCodigo() . "'";
        $insert = $this->conexao->query($sql);

        if ($insert->rowCount() > 0) {// se existir disciplina matriclada numa turma
            echo "<script>alert('Disciplina não pode ser deletado!');location.href=\"../view/consulta_disciplina.php\"</script> ";
        } else {
            $sql = "delete from disciplina where id = :matricula ";
            $insert = $this->conexao->prepare($sql);
            $insert->bindParam(':matricula', $this->getCodigo());
            $insert->execute();
            if ($insert != FALSE) {
                echo "<script>alert('Disciplina apagado com sucesso!');location.href=\"../view/consulta_disciplina.php\"</script> ";
            } else {
                echo "<script>alert('Ocorreu um erro!');location.href=\"../view/consulta_disciplina.php\"</script> ";
            }
        }
    }

}

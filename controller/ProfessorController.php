<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProfessorController
 *
 * @author ramon
 */
require_once '../autoload.php';//require_once '../model/Professor.php';

class ProfessorController {

    private $professor;
    private $apagar;
    private $atualizar;

    function __construct() {
        if (!isset($_SESSION)) {
            session_start();
        }

        $this->professor = new Professor();
        $this->incluir();
        if($this->atualizar === 'atualizar'){
            $this->professor->atualizar();
        }else if ($this->apagar === 'apagar') {
            $this->professor->apagar();
            echo "<script>alert('Professor apagado com sucesso!');location.href=\"../view/consulta_professor.php\"</script> ";
        } else {
            $this->professor->cadastrar();
            echo "<script>alert('Professor cadastrado com sucesso!');location.href=\"../view/cadastro_professor.php\"</script> ";
        }
    }

    private function incluir() {
       
        $this->professor->setMatricula($_POST['matricula']);
        $this->professor->setNome($_POST['nome']);
        $this->professor->setEmail($_POST['email']);
        $this->professor->setEndereco($_POST['endereco']);
        $this->professor->setTelefone($_POST['telefone']);
        $this->professor->setUsuarioAltera($_SESSION['login']);

        if (isset($_POST['apagar'])) {
            $this->apagar = $_POST['apagar'];
        }
        if(isset($_POST['atualizar'])){
            $this->atualizar = $_POST['atualizar'];
        }
        
    }

}

new ProfessorController();

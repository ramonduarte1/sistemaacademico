<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IncluiNotasController
 *
 * @author usuario
 */
class IncluiNotasController {

    function __construct() {
        if (!isset($_SESSION)) {
            session_start();
        }
        $this->incluir();
        var_dump($_SESSION['aluno_nota']);
    }

    private function incluir() {

        if ($_POST['n1']) {
            $_SESSION['aluno_nota'][$_POST['matricula']][$_POST['codigo']]['n1'] = $_POST['n1']; //matricula aluno -codigo disciplina -nota
        }

        if ($_POST['n2']) {
            $_SESSION['aluno_nota'][$_POST['matricula']][$_POST['codigo']]['n2'] = $_POST['n2'];
        }

        if ($_POST['n3']) {
            $_SESSION['aluno_nota'][$_POST['matricula']][$_POST['codigo']]['n3'] = $_POST['n3'];
        }
        
        $media = ($_SESSION['aluno_nota'][$_POST['matricula']][$_POST['codigo']]['n1'] +
                $_SESSION['aluno_nota'][$_POST['matricula']][$_POST['codigo']]['n2'] +
                $_SESSION['aluno_nota'][$_POST['matricula']][$_POST['codigo']]['n3']) / 3;
        
        $_SESSION['aluno_nota'][$_POST['matricula']][$_POST['codigo']]['media'] = $media;
         
        if ($media <= 3) {
             $_SESSION['aluno_nota'][$_POST['matricula']][$_POST['codigo']]['situacao'] = 'Reprovado';
        }
        if ($media > 3 && $media < 7) {
            $_SESSION['aluno_nota'][$_POST['matricula']][$_POST['codigo']]['situacao'] = 'Recuperação';
        }
        if ($media >= 7) {
            $_SESSION['aluno_nota'][$_POST['matricula']][$_POST['codigo']]['situacao'] = 'Aprovado';
        }
    }

}

new IncluiNotasController();

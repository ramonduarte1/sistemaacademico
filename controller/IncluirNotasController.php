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
        echo "<script>alert('Notas adicionadas com sucesso!');location.href=\"../view/lancar_notas.php\"</script> ";
        //var_dump($_SESSION['aluno_nota']);
    }

    private function incluir() {

        foreach ($_SESSION['codigos'] as $codigo) {

            if ($_POST['n1_'.$codigo]) {
                $_SESSION['aluno_nota'][$_POST['matricula']][$codigo]['n1'] = $_POST['n1_'.$codigo]; //matricula aluno -codigo disciplina -nota
            }

            if ($_POST['n2_'.$codigo]) {
                $_SESSION['aluno_nota'][$_POST['matricula']][$codigo]['n2'] = $_POST['n2_'.$codigo];
            }

            if ($_POST['n3_'.$codigo]) {
                $_SESSION['aluno_nota'][$_POST['matricula']][$codigo]['n3'] = $_POST['n3_'.$codigo];
            }

            $media = ($_SESSION['aluno_nota'][$_POST['matricula']][$codigo]['n1'] +
                    $_SESSION['aluno_nota'][$_POST['matricula']][$codigo]['n2'] +
                    $_SESSION['aluno_nota'][$_POST['matricula']][$codigo]['n3']) / 3;

            $_SESSION['aluno_nota'][$_POST['matricula']][$codigo]['media'] = $media;

            if ($media <= 3) {
                $_SESSION['aluno_nota'][$_POST['matricula']][$codigo]['situacao'] = 'Reprovado';
            }
            if ($media > 3 && $media < 7) {
                $_SESSION['aluno_nota'][$_POST['matricula']][$codigo]['situacao'] = 'Recuperação';
            }
            if ($media >= 7) {
                $_SESSION['aluno_nota'][$_POST['matricula']][$codigo]['situacao'] = 'Aprovado';
            }
        }
    }

}

new IncluiNotasController();

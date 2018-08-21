<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//    <fieldset>
//        <legend>Select a maintenance drone</legend>


session_start();
foreach ($_SESSION['alunos_matriculados'] as $matricula => $aluno) {

    $pesquisa = $_POST['pesq_aluno'];

    $pattern = '/' . $pesquisa . '/'; //Padrão a ser encontrado na string $tags
    if (preg_match($pattern, $aluno['aluno']['nome'])) {

        echo "<h2 class='centralizado'>Aluno</h2><br>"
        . "Matricula<input size='2' value='" . $matricula . "'>Nome:<input value='" . $aluno['aluno']['nome'] . "'>"
        . "Email<input value='" . $aluno['aluno']['email'] . "'><br><br>Endereco<input value='" . $aluno['aluno']['endereco'] . "'>"
        . "Telefone<input value='" . $aluno['aluno']['telefone'] . "'><br>"
        . "<br><h2 class='centralizado'>Disciplinas</h2><br>";

        foreach ($aluno['disciplina'] as $codigo => $nome) {
            echo "<form action='../controller/IncluirNotasController.php' method='post'>"
            . "Codigo<input size='2' name='codigo' value='" . $codigo . "'>Nome<input value='" . $nome . "'>"
            . "nota 1<input size='2' type='text' name='n1' value='".$_SESSION['aluno_nota'][$matricula][$codigo]['n1']."'>"//pega as notas da sessao aluno_nota
            . "nota 2<input size='2' type='text' name='n2' value='".$_SESSION['aluno_nota'][$matricula][$codigo]['n2']."'>"
            . "nota 3<input size='2'type='text' name='n3'value='".$_SESSION['aluno_nota'][$matricula][$codigo]['n3']."'>"
            . "<input type='hidden' name='matricula' value='" . $matricula . "'>"
            . "&ensp;<button>salvar</button>"
            . "</form><br><br>";
        }

        echo "<br><h2 class='centralizado'>Turmas</h2><br>";

        foreach ($aluno['turma'] as $codigo => $nome) {
            echo "Codigo<input size='2' value='" . $codigo . "'>Nome<input value='" . $nome . "'>";
        }
    }
}

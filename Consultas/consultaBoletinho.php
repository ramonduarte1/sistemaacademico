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
// <fieldset><legend>Boletinho:</legend>
        echo 
        "
         <table border='1'>"
        . "<tr>"
        . "<td colspan='8'>Aluno</td>"
        . "</tr>"
        . "<tr>"
                . "<th>Matricula</th>"
                . "<th>Nome</th>"
                . "<th>Email</th>"
                . "<th colspan='4'>Endereco</th>"
                . "<th>Telefone</th>"
        . "</tr>"
        . "<tr>"
                . "<td>$matricula</td>"
                . "<td>".$aluno['aluno']['nome']."</td>"
                . "<td>".$aluno['aluno']['email']."</td>"
                . "<td colspan='4'>".$aluno['aluno']['endereco']."</td>"
                . "<td>".$aluno['aluno']['telefone']."</td>"
        . "</tr>"
                . "<tr>"
                . "<td colspan='8' >Disciplinas</td>"
                . "</tr>".
        "<tr>"
                . "<tr>"
                . "<th>Codigo</th>"
                . "<th>Nome</th>"
                . "<th>Carga Horária</th>"
                . "<th>Nota 1</th>"
                . "<th>Nota 2</th>"
                . "<th>Nota 3</th>"
                . "<th>Media</th>"
                . "<th>Situação</th>"
        . "</tr>";

       foreach ($aluno['disciplina'] as $codigo => $nome) {
            echo 

            "<tr>"
           . "<td>$codigo</td>"
                    . "<td>$nome</td>"
                    . "<td>" .  $_SESSION['disciplinas'][$codigo]['carga_horaria'] . "</td>"
                    . "<td>" . $_SESSION['aluno_nota'][$matricula][$codigo]['n1'] . "</td>"
                    . "<td>" . $_SESSION['aluno_nota'][$matricula][$codigo]['n2'] . "</td>"
                    . "<td>" . $_SESSION['aluno_nota'][$matricula][$codigo]['n3'] . "</td>"
                    . "<td>" . number_format($_SESSION['aluno_nota'][$matricula][$codigo]['media'],2) . "</td>"//formata para duas casas decimais
                    . "<td>" . $_SESSION['aluno_nota'][$matricula][$codigo]['situacao'] . "</td>"
           . "</tr>";

        }
        echo 
        "<tr>"
        . "<td colspan='8'>Turmas</td>"
        . "</tr>";

        

        foreach ($aluno['turma'] as $codigo => $nome) {
            echo 
            "<tr>"
                . "<th>Codigo</th>"
                . "<th colspan='7' >Nome</th>"
            ."</tr>"
            . "<tr>"
                . "<td>$codigo</td>"
                . "<td colspan='7'>$nome</td>"
            . "</tr>"
                    . "<tr>"
                    . "<td colspan='7'></td>"
                    . "<td><button onclick='imprimeBoletinho()'>Imprimir</button>"
                    . "</tr>";
        }
        
        
    }
}

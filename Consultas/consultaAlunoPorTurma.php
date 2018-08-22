<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
foreach ($_SESSION['turmas'] as $matricula => $turma) {

    $pesquisa = $_POST['pesq_turma'];

    $pattern = '/' . $pesquisa . '/'; //Padrão a ser encontrado na string $tags
         if (preg_match($pattern, $turma['nome'])) {
             echo "
                <table>
                   <tr>
                       <th>Matricula</th>
                       <th>Nome</th>
                   </tr>
                   <tr>
                         <td><input size='4' readonly name='codigo_turma' id='codigo_turma' value='" . $matricula . "'></td>
                         <td><input readonly name='nome' type='text' value='" . $turma['nome'] . "'></td>
                         <td><button onclick='consultaAlunoPorTurma()'>listar</button></td>
                   </tr>
                </table>";
         }
}

//ok
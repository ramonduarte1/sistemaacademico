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
    if (preg_match($pattern, $aluno['nome'])) {
        echo "<table>
                   <tr>
                    <td>
                     <form action='../controller/LancarNotaController.php' method='post'>
                            <input size='4' readonly name='matricula' value='" . $matricula . "'>
                            <input name='nome' type='text' value='" . $aluno['aluno']['nome'] . "'>
                            <input name='email' type='text' value='" . $aluno['aluno']['email'] . "'>
                            <input name='endereco' type='text' value='" . $aluno['aluno']['endereco'] . "'>
                            <input name='telefone' type='text' value='" . $aluno['aluno']['telefone'] . "'>
                            <button>salvar</button>
                     </form>
                    </td>
                    <td>
                    <form action='../controller/AlunoController.php' method='post'>
                       <input name='matricula' type='hidden' value='" . $matricula . "'>
                       <input name='apagar' type='hidden' value='apagar'>
                       <button>apagar</button></td>
                    </form>
                    </tr></table><br>";
    }
}

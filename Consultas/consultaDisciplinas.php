<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
foreach ($_SESSION['disciplinas'] as $matricula => $disciplina) {

    $pesquisa = $_POST['pesq_disciplina'];

    $pattern = '/' . $pesquisa . '/'; //Padrão a ser encontrado na string $tags
    if (preg_match($pattern, $disciplina['nome'])) {
        echo "<table>
                   <tr>
                    <td>
                     <form action='../controller/DisciplinaController.php' method='post'>
                            <input size='4' readonly name='matricula' value='" . $matricula . "'>
                            <input name='nome' type='text' value='" . $disciplina['nome'] . "'>
                            <input name='carga_horaria' type='text' value='" . $disciplina['carga_horaria']. "'>
                            <button>salvar</button>
                     </form>
                    </td>
                    <td>
                    <form action='../controller/DisciplinaController.php' method='post'>
                       <input name='matricula' type='hidden' value='" . $matricula . "'>
                       <input name='apagar' type='hidden' value='apagar'>
                       <button>apagar</button>
                    </form>
                    </td>
                    
                    </tr>
             </table>
             <br>";

    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
foreach ($_SESSION['turmas'] as $matricula => $turma) {

    $pesquisa = $_POST['pesq_turmas'];

    $pattern = '/' . $pesquisa . '/'; //Padrão a ser encontrado na string $tags
    if (preg_match($pattern, $turma['nome'])) {
        echo "
           <form action='../controller/TurmaController.php' method='post'>
           <table>
              <tr>
                  <th>Matricula</th>
                  <th>Nome</th>
              </tr>
              <tr>
                    <td><input size='4' readonly name='matricula' value='" . $matricula . "'></td>
                    <td><input name='nome' type='text' value='" . $turma['nome'] . "'></td>
                    <td><button>salvar</button></td>
           </form>
                    <td>
                      <form action='../controller/TurmaController.php' method='post'>
                         <input name='matricula' type='hidden' value='" . $matricula . "'>
                         <input name='apagar' type='hidden' value='apagar'>
                         <button>apagar</button>
                      </form>
                    </td>
              </tr>
           </table>";

    }
}
//ok
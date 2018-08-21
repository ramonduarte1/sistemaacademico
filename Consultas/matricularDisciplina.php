<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
foreach ($_SESSION['disciplinas'] as $matricula => $disciplina) {
    
          $pesquisa = $_POST['pesq_disciplina'];

          $pattern = '/' . $pesquisa . '/';//Padrão a ser encontrado na string $tags
          if (preg_match($pattern, $disciplina['nome'])) {
              echo "<table>
                            <tr>
                            <td>
                               <form method=\"POST\" action=\"../controller/MatriculaController.php\">
                                    <input readonly size='3' name='disciplina' value='$matricula'>
                                    <input name='nome' type='text' value='" . $disciplina['nome'] . "'>
                                    <input name='carga_horaria' type='text' value='" . $disciplina['carga_horaria']. "'>
                                    <button>Incluir</button>
                               </form>    
                            </td>
                            </tr>
                    </table>";
          }
    
}


    
//ok
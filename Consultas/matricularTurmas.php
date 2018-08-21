<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


session_start();
foreach ($_SESSION['turmas'] as $matricula => $turma) {
    
          $pesquisa = $_POST['pesq_turmas'];

          $pattern = '/' . $pesquisa . '/';//Padrão a ser encontrado na string $tags
          if (preg_match($pattern, $turma['nome'])) {
              echo "<table class='centralizado'>
                            <tr>
                            <td>
                            <form method=\"POST\" action=\"../controller/MatriculaController.php\">
                                <input readonly size='3' name='turma' value='$matricula'>
                                <input name='nome' value='".$turma['nome']."'>
                                <input type='submit' value='Incluir'>
                                </td>
                            </form>
                            </tr></table>";
          }
    
}

    
//ok
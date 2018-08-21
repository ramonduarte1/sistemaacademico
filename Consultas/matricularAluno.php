<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


session_start();
foreach ($_SESSION['alunos'] as $matricula => $aluno) {
    
          $pesquisa = $_POST['pesq_aluno'];

          $pattern = '/' . $pesquisa . '/';//Padrão a ser encontrado na string $tags
          if (preg_match($pattern, $aluno['nome'])) {
              echo "<table class='centralizado'>
                            <tr>
                            <td>
                            <form method=\"POST\" action=\"../controller/MatriculaController.php\">
                                <input readonly size='3' name='matricula' value='$matricula'>
                                <input name='nome' value='".$aluno['nome']."'>
                                <input name='email' value='".$aluno['email']."'>
                                <input type='submit' value='Incluir'  name='aluno'>
                                </td>
                            </form>
                            </tr></table>";
          }
    
}

    
//ok
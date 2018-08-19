<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
foreach ($_SESSION['professores'] as $matricula => $professor) {
    
          $pesquisa = $_POST['pesq_professor'];

          $pattern = '/' . $pesquisa . '/';//Padrão a ser encontrado na string $tags
          if (preg_match($pattern, $professor['nome'])) {
             echo "<table>
                   <tr>
                    <td>
                     <form action='../controller/ProfessorController.php' method='post'>
                            <input size='4' readonly name='matricula' value='".$matricula."'>
                            <input name='nome' type='text' value='".$professor['nome']."'>
                            <input name='email' type='text' value='".$professor['email']."'>
                            <input name='endereco' type='text' value='".$professor['endereco']."'>
                            <input name='telefone' type='text' value='".$professor['telefone']."'>
                            <button>salvar</button>
                     </form>
                    </td>
                    <td>
                    <form action='../controller/ProfessorController.php' method='post'>
                       <input name='matricula' type='hidden' value='".$matricula."'>
                       <input name='apagar' type='hidden' value='apagar'>
                       <button>apagar</button></td>
                    </form>
                    </tr></table><br>";
          }
    
}

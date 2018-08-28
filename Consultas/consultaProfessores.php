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
         echo "
                    <form action='../controller/ProfessorController.php' method='post'>
                    <table>
                       <tr>
                           <th>Matricula</th>
                           <th>Nome</th>
                           <th>Email</th>
                           <th>Endereço</th>
                           <th>Telefone</th>
                       </tr>
                       <tr>
                           <td><input required size='4' readonly name='matricula' value='".$matricula."'></td>
                           <td><input required name='nome' type='text' value='".$professor['nome']."'></td>
                           <td><input required name='email' type='text' value='".$professor['email']."'></td>
                           <td><input required name='endereco' type='text' value='".$professor['endereco']."'></td>
                           <td><input required name='telefone' onkeypress=\"mascara(this, '## #####-####')\" maxlength=\"13\" type='text' value='".$professor['telefone']."'></td>
                           <td><button>salvar</button></td>
                           </form>
                           <td>
                               <form action='../controller/ProfessorController.php' method='post'>
                                  <input name='matricula' type='hidden' value='".$matricula."'>
                                  <input name='apagar' type='hidden' value='apagar'>
                                  <button>apagar</button></td>
                               </form>
                           </td>
                       </tr>
                    </table>";
          }
    
}
//ok
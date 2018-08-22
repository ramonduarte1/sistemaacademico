<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//    <fieldset>
//        <legend>Select a maintenance drone</legend>


session_start();
foreach ($_SESSION['alunos'] as $matricula => $aluno) {
    
          $pesquisa = $_POST['pesq_aluno'];

          $pattern = '/' . $pesquisa . '/';//Padrão a ser encontrado na string $tags
          if (preg_match($pattern, $aluno['nome'])) {
             echo "
                    <form action='../controller/AlunoController.php' method='post'>
                    <table>
                       <tr>
                           <th>Matricula</th>
                           <th>Nome</th>
                           <th>Email</th>
                           <th>Endereço</th>
                           <th>Telefone</th>
                       </tr>
                       <tr>
                           <td><input size='4' readonly name='matricula' value='".$matricula."'></td>
                           <td><input required name='nome' type='text' value='".$aluno['nome']."'></td>
                           <td><input required name='email' type='text' value='".$aluno['email']."'></td>
                           <td><input required name='endereco' type='text' value='".$aluno['endereco']."'></td>
                           <td><input required name='telefone' onkeypress=\"mascara(this, '## #####-####')\" maxlength=\"13\" type='text' value='".$aluno['telefone']."' ></td>
                           <td><button>salvar</button></td>
                           </form>
                           <td>
                               <form action='../controller/AlunoController.php' method='post'>
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
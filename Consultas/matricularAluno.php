<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$resposta = '              
            <tr>
                <th>Matricula</th>
                <th>Nome</th>
                <th>email</th>
                <th>endereço</th>
                <th>Telefone</th>
                <th><th>
                <th><th>
            </tr>';
session_start();
foreach ($_SESSION['alunos'] as $matricula => $aluno) {
    
          $pesquisa = $_POST['pesq_aluno'];

          $pattern = '/' . $pesquisa . '/';//Padrão a ser encontrado na string $tags
          if (preg_match($pattern, $aluno['nome'])) {
              $resposta .=  "
                            <tr>
                            <form method=\"POST\" action=\"../controller/MatriculaController.php\">
                                <td><input readonly name='matricula' value='$matricula'></>
                                <td><input name='nome' value=".$aluno['nome']."></td>
                                <td><input name='email' value=".$aluno['email']."></td>
                                <td><input name='endereco' value=".$aluno['endereco']."></td>
                                <td><input name='telefone' value=".$aluno['telefone']."></td>
                                <td><input type='submit' value='Incluir'  name='aluno'></td>
                            </form>
                            </tr>";
          }
    
}
if(!empty($resposta)){
    echo $resposta;
}else{
    echo 'Aluno não encontrado!';
}

    

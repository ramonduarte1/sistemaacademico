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
foreach ($_SESSION['professores'] as $matricula => $professor) {
    
          $pesquisa = $_POST['pesq_professor'];

          $pattern = '/' . $pesquisa . '/';//Padrão a ser encontrado na string $tags
          if (preg_match($pattern, $professor['nome'])) {
              $resposta .=  "
                            <tr>
                                <form action="."../controller/AlunoController.php"." method="."post".">
                                    <td><input readonly name='matricula' value='$matricula'></>
                                    <td><input name='nome' value=".$professor['nome']."></td>
                                    <td><input name='email' value=".$professor['email']."></td>
                                    <td><input name='endereco' value=".$professor['endereco']."></td>
                                    <td><input name='telefone' value=".$professor['telefone']."></td>
                                    <td><button>salvar</button></td>
                                </form>
                                <form action="."../controller/AlunoController.php"." method="."post".">
                                    <td><input type='button' value='apagar'></td>
                                </form>
                                
                            </tr>";
          
          }
    
}
if(!empty($resposta)){
    echo $resposta;
}else{
    echo 'Professor não encontrado!';
}

    

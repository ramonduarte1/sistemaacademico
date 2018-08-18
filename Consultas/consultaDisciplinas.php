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
                <th>Carga Horária</th>
                <th><th>
                <th><th>
            </tr>';
session_start();
foreach ($_SESSION['disciplinas'] as $matricula => $disciplina) {
    
          $pesquisa = $_POST['pesq_disciplina'];

          $pattern = '/' . $pesquisa . '/';//Padrão a ser encontrado na string $tags
          if (preg_match($pattern, $disciplina['nome'])) {
              $resposta .=  "
                            <tr>
                                <form action="."../controller/AlunoController.php"." method="."post".">
                                    <td><input readonly name='matricula' value='$matricula'></>
                                    <td><input name='nome' value=".$disciplina['nome']."></td>
                                    <td><input name='carga_horaria' value=".$disciplina['carga_horaria']."></td>
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
    echo 'Disciplina não encontrado!';
}

    

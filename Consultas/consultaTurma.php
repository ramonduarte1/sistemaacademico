<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$resposta = '';
session_start();
foreach ($_SESSION['turmas'] as $matricula => $turma) {
    
          $pesquisa = $_POST['pesquisa'];

          $pattern = '/' . $pesquisa . '/';//Padrão a ser encontrado na string $tags
          if (preg_match($pattern, $turma['nome'])) {
              $resposta .=  "<tr>
                                <td>Matricula</td>
                                <td>".$matricula."</td>
                            </tr>
                            <tr>
                                <td>Nome</td>
                                <td>".$turma['nome']."</td>
                            </tr>";
          
          } 
    
}
if(!empty($resposta)){
    echo $resposta;
}else{
    echo 'Turma não encontrada!';
}

    
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$resposta = '';
session_start();
foreach ($_SESSION['professores'] as $matricula => $professor) {
    
          $pesquisa = $_POST['pesquisa'];

          $pattern = '/' . $pesquisa . '/';//Padrão a ser encontrado na string $tags
          if (preg_match($pattern, $professor['nome'])) {
              $resposta .= "<tr>
                                <td>Matricula</td>
                                <td>".$matricula."</td>
                            </tr>
                            <tr>
                                <td>Nome</td>
                                <td>".$professor['nome']."</td>
                            </tr>
                            <tr>
                                 <td>Email</td>
                                 <td>".$professor['email']."</td>
                            </tr>
                            <tr>
                                 <td>Endereço</td>
                                 <td>".$professor['endereco']."</td>
                            </tr>";
          
          } 
}
if(!empty($resposta)){
    echo $resposta;
}else{
    echo 'Professor não encontrado!';
}

    
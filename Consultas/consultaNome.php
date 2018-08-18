<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$resposta = '';
session_start();
foreach ($_SESSION['alunos'] as $matricula => $professor) {
    
          $pesquisa = $_POST['pesq_aluno'];

          $pattern = '/' . $pesquisa . '/';//Padrão a ser encontrado na string $tags
          if (preg_match($pattern, $professor['nome'])) {
              $resposta =  $professor['nome'];
          }
    
}
if(!empty($resposta)){
    echo $resposta;
}else{
    echo 'Aluno não encontrado!';
}

    
